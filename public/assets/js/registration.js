function getValidationData(field) {
  if (field.type === 'hidden') {
    return { isValid: true };
  }
  
  switch (field.tagName.toLowerCase()) {
    case 'input':
      switch (field.type) {
        case 'text':
        case 'number':
        case 'email':
          if (field.name === 'latestAverage') {
            const selectedGrade = document.getElementById('incomingGrade').value;
            if (selectedGrade === 'GradeSeven' || selectedGrade === 'GradeEight' || selectedGrade === 'GradeNine' || selectedGrade === 'GradeTen') {
              if (field.value.trim() === '') {
                return {
                  isValid: false,
                  message: 'Please complete this required field.'
                };
              }
              return validateLatestAverage(field, 88, 100);
            } else {
              return { isValid: true };
            }
          }   
          if (field.name === 'equivalentGrade') {
            const selectedGrade = document.getElementById('incomingGrade').value;
            if (selectedGrade === 'GradeTwelve' || selectedGrade === 'FirstYear' || selectedGrade === 'SecondYear' || selectedGrade === 'ThirdYear') {
              if (field.value.trim() === '') {
                return {
                  isValid: false,
                  message: 'Please complete this required field.'
                };
              }
              return validateNumberRange(field, 88, 100);
            } else {
              return { isValid: true }; 
            }
          }
          return validateNumber(field);
        case 'password':
          if (field.id === 'passwordField') {
            return validatePassword(field);
          } else if (field.id === 'confirmPasswordField') {
            return validateConfirmPassword(field);
          } else {
            throw new Error(`The provided field type '${field.type}' with ID '${field.id}' is not supported in this form.`);
          }
        case 'date':
          if (field.name === 'birthdate' || field.id === 'birthdate') {
            return validateDate(field); 
          } else if (field.name === 'orientation_date') {
            return validateDate(field); 
          }
          break;
        case 'tel':
          return validatePhone(field);
        case 'checkbox':
        case 'radio':
          return validateChoice(field);
        case 'file':
          if (field.name === 'orientation_proof') {
            return validateOrientationProof(field); 
          }
          if (field.name === 'payslip') {
            return validatePayslip(field);
          }
          if (field.name === 'applicationForm') { 
            return validateApplicationForm(field); 
          }
          if (field.name === 'characterReferences') { 
            return validateCharacterReferences(field); 
          }
          if (field.name === 'reportCard') {
            return validateReportCard(field);
          } else if (field.name === 'mapAddress') {
            return validateMapAddress(field);
          } else if (field.name === 'ReportCard') { 
            return validateReportCard(field); 
          // } else if (field.name === 'payslip') { 
          //   return validatePayslip(field); 
          }
          else {
            throw new Error(`The provided file input field with name '${field.name}' is not supported in this form.`);
          }
          
        default:
          throw new Error(`The provided field type '${field.tagName}:${field.type}' is not supported in this form.`);
      }
    case 'textarea':
      // if (field.name === 'noteAddress') {
      //   if (field.value.trim() === '') {
      //     return {
      //       isValid: false,
        
      //     };
      //   }
      //   return { isValid: true };
      // } else {
      //   throw new Error(`The provided field type 'TEXTAREA:${field.name}' is not supported in this form.`);
      // }
      case 'select':
      if (field.name === 'attend-orientation' || field.id === 'attend-orientation') {
        const selectedOption = field.value;
        if (selectedOption === '') {
          return {
            isValid: false,
            message: 'Please select an option for orientation attendance.'
          };
        } else if (selectedOption === 'no') {
          return {
            isValid: false,
            message: 'You cannot apply for the scholarship without attending the orientation. Please wait for the next scheduled orientation session.'
          };
        } else {
          return { isValid: true };
        }
      }
      
      if (field.name === 'incomingGrade' || field.id === 'incomingGrade') {
        const selectedOption = field.value;
        if (selectedOption === '') {
          return {
            isValid: false,
            message: 'Please select a grade or year level.'
          };
        } else {
          return { isValid: true };
        }
      }
      
    default:
      throw new Error(`The provided field type '${field.tagName}' is not supported in this form.`);
  }
};

const validateChoice = field => {
  return validateGroup(field.closest('fieldset'));
};

/*****************************************************************************
 * Expects a Node (input[type="tel"]).
 */

  const isPDFFile = (filename) => {
    return /\.(pdf)$/i.test(filename);
  };
  
  const isImageFile = (filename) => {
    return /\.(jpe?g|png)$/i.test(filename);
  };

  //validition for phone
  const validatePhone = field => {
    const val = field.value.trim();

    if (val === '' && field.required) {
      return {
        isValid: false
      };
    } else if (val !== '' && !isValidPhone(val)) {
      return {
        isValid: false,
        message: 'Please provide a valid phone number.'
      };
    } else {
      return {
        isValid: true
      };
    }
  };

  //validition for report card
  const validateReportCard = field => {
    const val = field.value.trim();
    if (val === '' && field.required) {
      return {
        isValid: false
      };
    } else if (val !== '' && !isPDFFile(val)) {
      return {
        isValid: false,
        message: 'Please upload pdf file only.'
      };
    } else {
      return {
        isValid: true
      };
    }
  };

  //validition for map address
  const validateMapAddress = field => {
    const val = field.value.trim();
    if (val === '' && field.hasAttribute('required')) {
      return {
        isValid: false,
      };
    } else if (val !== '' && !isImageFile(val)) {
      return {
        isValid: false,
        message: 'Please upload JPG, JPEG, or PNG files only.'
      };
    } else {
      return {
        isValid: true
      };
    }
  };
  
  //validition for payslip file
  const validatePayslip = (field) => {
    const val = field.value.trim();
    if (val === '' && field.required) {
      return {
        isValid: false,
      };
    } else if (val !== '' && !isPDFFile(val)) {
      return {
        isValid: false,
        message: 'Please upload a PDF file only.'
      };
    } else {
      return {
        isValid: true
      };
    }
  };

  //validition for application form file
  const validateApplicationForm = (field) => {
    const val = field.value.trim();
    if (val === '' && field.required) {
      return {
        isValid: false,
        message: 'Please complete this required field'
      };
    } else if (val !== '' && !isPDFFile(val)) {
      return {
        isValid: false,
        message: 'Please upload a PDF file only.'
      };
    } else {
      return {
        isValid: true
      };
    }
  };

  //validation for character references file
  const validateCharacterReferences = (field) => {
    const val = field.value.trim();
    if (val === '' && field.required) {
      return {
        isValid: false,
        message: 'Please complete this required field'
      };
    } else if (val !== '' && !isPDFFile(val)) {
      return {
        isValid: false,
        message: 'Please upload a PDF file only.'
      };
    } else {
      return {
        isValid: true
      };
    }
  };

  //validition for attendance
  const validateOrientationProof = field => {
    const val = field.value.trim();
    if (val === '' && field.required) {
      return {
        isValid: false,
      };
    } else if (val !== '' && !(isImageFile(val) || isPDFFile(val))) {
      return {
        isValid: false,
        message: 'Please upload JPG, JPEG, PNG, or PDF files only.'
      };
    } else {
      return {
        isValid: true
      };
    }
  };
  

/*****************************************************************************
 * Expects a Node (input[type="email"]).
 */

const validateEmail = field => {
  const val = field.value.trim();

  if (val === '' && field.required) {
    return {
      isValid: false
    };
  } else if (val !== '' && !isValidEmail(val)) {
    return {
      isValid: false,
      message: 'Please provide a valid email address.'
    };
  } else {
    return {
      isValid: true
    };
  }
};

/*****************************************************************************
 * Expects a Node (field or fieldset).
 *
 * Returns an object describing the field's overall validity, as well as
 * a possible error message where additional information may be helpful for
 * the user to complete the field.
 */

const validateFileType = (field, expectedType) => {
  const file = field.files[0]; 
  if (file && file.type !== expectedType) {
    return {
      isValid: false,
      message: `Please upload a PDF file.`
    };
  }
  return { isValid: true };
};

const validateGroup = fieldset => {
  if (!fieldset) {
      return {
          isValid: false,
          message: 'Fieldset element not found.'
      };
  }

  const checkbox = fieldset.querySelector('input[type="checkbox"]');

  if (checkbox) {
      checkbox.setAttribute('required', 'required');
  }

  const isChecked = checkbox && checkbox.checked;

  if (!isChecked) {
      return {
          isValid: false,
          message: 'Please ensure the checkbox is checked to proceed with your application.'
      };
  } else {
      return {
          isValid: true
      };
  }
};

console.clear();

function ready(fn) {
  if (document.readyState === 'complete' || document.readyState === 'interactive') {
    setTimeout(fn, 1);
    document.removeEventListener('DOMContentLoaded', fn);
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
}

const isValidPhone = val => {
  const regex = new RegExp(/^(?:(?:\+|0{0,2})63|0)?\s?(\d{3})[-.\s]?(\d{3})[-.\s]?(\d{4})$/);

  return regex.test(val);
};

/*****************************************************************************/

const isValidEmail = val => {
  const regex = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);

  return regex.test(val);
};

/*****************************************************************************
 * Expects a Node (input[type="text"] or textarea).
 */

const validateText = field => {
  const val = field.value.trim();

  if ((val === '' || val === 'Invalid Date') && field.required) {
    return {
      isValid: false
    };
  } else {
    return {
      isValid: true
    };
  }
};

/*****************************************************************************
* Birthdate and Orientation Date Validation
*/
const validateDate = field => { 
  const val = field.value.trim();

  if (val === '' && field.required) {
    return {
      isValid: false,
    };
  }

  if (field.name === 'birthdate') {
    const currentDate = new Date();
    const selectedDate = new Date(val);
    const ageInYears = (currentDate - selectedDate) / (365 * 24 * 60 * 60 * 1000);
  
    if (ageInYears > 25) {
      return {
        isValid: false,
        message: 'Should not be more than 25 years of age upon admission'
      };
    }
  }
  
  if (field.name === 'orientation_date') {
    return {
      isValid: true
    };
  }

  return {
    isValid: true
  };
};

/*****************************************************************************
* Number Input Field Validation
*/
const validateNumber = (field) => {
  const val = field.value.trim();

  if (val === '' && field.required) {
    return {
      isValid: false,
      message: 'Please complete this required field.'
    };
  } else {
    // Perform number validation logic here if needed
    return { isValid: true };
  }
};

/*****************************************************************************
* Grades Validation
*/
const validateNumberRange = (field, min, max) => {
  const value = parseFloat(field.value);
  if (isNaN(value) || value < min || value > max) {
    return {
      isValid: false,
      message: `To qualify for the scholarship, your GWA must be equivalent to at least 88%.`
    };
  }
  return { isValid: true };
};

/*****************************************************************************
* Average Validation
*/
const validateLatestAverage = (field, minPercentage) => {
  const value = parseFloat(field.value);
  if (isNaN(value) || value < minPercentage || value > 100) {
    return {
      isValid: false,
      message: `To qualify for the scholarship, your General Average must be at least ${minPercentage}%.`
    };
  }
  return { isValid: true };
};

/*****************************************************************************
* Password Validation
*/
const validatePassword = field => {
  const val = field.value.trim();

  if (val === '' && field.required) {
    return {
      isValid: false,
    };
  }

  const hasLowercase = /[a-z]/.test(val);

  const hasUppercase = /[A-Z]/.test(val);

  const hasNumber = /\d/.test(val);

  const hasMinLength = val.length >= 8;

  if (!(hasLowercase && hasUppercase && hasNumber && hasMinLength)) {
    return {
      isValid: false,
      message: 'Requires one lowercase letter, one capital letter, one number, and a minimum of 8 characters.'
    };
  }

  return {
    isValid: true
  };
};

/*****************************************************************************
* Confirm Password Validation
*/
const validateConfirmPassword = field => {
  const val = field.value.trim();
  const passwordField = document.getElementById('passwordField');
  const password = passwordField.value.trim();

  if (val === '' && field.required) {
    return {
      isValid: false,
      message: 'Please confirm your password.'
    };
  }

  if (val !== password) {
    return {
      isValid: false,
      message: 'Password and Confirm Password doesn\'t match.'
    };
  }

  return {
    isValid: true
  };
};

/*****************************************************************************
* Dropdown Validation
*/
const validateSelect = field => {
  const val = field.value.trim();

  if (val === '' && field.required) {
    return {
      isValid: false,
      message: 'Please select an option from the dropdown menu.'
    };
  } else {
    return {
      isValid: true
    };
  }
};

/*****************************************************************************/
ready(function () {

  // Global Constants
  const progressForm = document.getElementById('progress-form');

  const tabItems = progressForm.querySelectorAll('[role="tab"]')
    , tabPanels = progressForm.querySelectorAll('[role="tabpanel"]');

  let currentStep = 0;

  const isValid = field => {
    return getValidationData(field).isValid;
  };

  /*****************************************************************************
   * Expects an integer.
   *
   * Returns a promise that either resolves if all fields in a given step are
   * valid, or rejects and returns invalid fields for further processing.
   */

  const validateStep = currentStep => {
    const fields = tabPanels[currentStep].querySelectorAll('input:not([type="radio"]):not([type="checkbox"]), select, textarea, input[type="checkbox"], input[type="radio"]');
  
    const invalidFields = [...fields].filter(field => {
      return !isValid(field);
    });
  
    return new Promise((resolve, reject) => {
      if (invalidFields && !invalidFields.length) {
        resolve();
      } else {
        reject(invalidFields);
      }
    });
  };
  
  // Form Error and Success
  
  const FIELD_ERROR_CLASS = 'form__error-text';
  /*****************************************************************************
   * Expects a Node (fieldset) that contains any number of radio or checkbox
   * input elements, and a string representing the group's validation status.
   */

  function updateChoice(fieldset, status, errorId = '') {
    const choices = fieldset ? fieldset.querySelectorAll('[type="radio"], [type="checkbox"]') : [];
  
    for (const choice of choices) {
      if (status) {
        choice.setAttribute('aria-invalid', 'true');
        choice.setAttribute('aria-describedby', errorId);
      } else {
        choice.removeAttribute('aria-invalid');
        choice.removeAttribute('aria-describedby');
      }
    }
  }
  /*****************************************************************************
   * Expects a Node (field or fieldset) that either has the class name defined
   * by `FIELD_PARENT_CLASS`, or has a parent with that class name. Optional
   * string defines the error message.
   *
   * Builds and appends an error message to the parent element, or updates an
   * existing error message.
   *
   * https://www.davidmacd.com/blog/test-aria-describedby-errormessage-aria-live.html
   */

  function reportError(field, message = 'Please complete this required field.') {
    const fieldParent = field.closest('.form__field');
  
    if (fieldParent) {
      let fieldError = fieldParent.querySelector(`.${FIELD_ERROR_CLASS}`);
  
      if (!fieldError) {
        fieldError = document.createElement('p');
        fieldError.classList.add(FIELD_ERROR_CLASS);
        fieldParent.appendChild(fieldError);
      }
  
      fieldError.textContent = message;
      fieldError.style.display = 'block';
    }
  }
  
  /*****************************************************************************
   * Expects a Node (field or fieldset) that either has the class name defined
   * by `FIELD_PARENT_CLASS`, or has a parent with that class name.
   *
   * https://www.davidmacd.com/blog/test-aria-describedby-errormessage-aria-live.html
   */

  function reportSuccess(field) {
    const fieldParent = field.closest('.form__field');
  
    if (fieldParent) {
      const fieldError = fieldParent.querySelector(`.${FIELD_ERROR_CLASS}`);
  
      if (fieldError) {
        fieldError.textContent = '';
        fieldError.style.display = 'none';
      }
    }
  }

// Add event listener for checkbox click event
document.getElementById('consent').addEventListener('click', validateCheckbox);

function validateCheckbox() {
  const checkbox = document.getElementById('consent');
  const fieldsetParent = checkbox.closest('fieldset');
  const errorMessage = 'Please check this box if you want to proceed.';

  if (!fieldsetParent) {
      console.error('Fieldset element not found.');
      return;
  }

  const validationResult = validateGroup(fieldsetParent);

  if (!checkbox.checked) {
      reportError(checkbox, errorMessage);
      updateChoice(fieldsetParent, true);
  } else {
      reportSuccess(checkbox);
      updateChoice(fieldsetParent, false);
  }

  if (!validationResult.isValid) {
      reportError(fieldsetParent, validationResult.message);
      updateChoice(fieldsetParent, true);
  } else {
      reportSuccess(fieldsetParent);
      updateChoice(fieldsetParent, false);
  }
}

  /*****************************************************************************
   * Expects a Node (field or fieldset).
   *
   * Reports the field's overall validity to the user based on conditions set
   * within `getValidationData()`.
   */

  function reportValidity(field) {
    const validation = getValidationData(field);

    if (!validation.isValid && validation.message) {
      reportError(field, validation.message);
    } else if (!validation.isValid) {
      reportError(field);
    } else {
      reportSuccess(field);
    }
  }

  // Form Progression

  /*****************************************************************************
   * Resets the state of all tabs and tab panels.
   */

  function deactivateTabs() {
    // Reset state of all tab items
    tabItems.forEach(tab => {
      tab.setAttribute('aria-selected', 'false');
      tab.setAttribute('tabindex', '-1');
    });

    // Reset state of all panels
    tabPanels.forEach(panel => {
      panel.setAttribute('hidden', '');
    });
  }

  /*****************************************************************************
   * Expects an integer.
   *
   * Shows the desired tab and its associated tab panel, then updates the form's
   * current step to match the tab's index.
   */

  function activateTab(index) {
    const thisTab = tabItems[index]
      , thisPanel = tabPanels[index];

    // Close all other tabs
    deactivateTabs();

    // Focus the activated tab for accessibility
    thisTab.focus();

    // Set the interacted tab to active
    thisTab.setAttribute('aria-selected', 'true');
    thisTab.removeAttribute('tabindex');

    // Display the associated tab panel
    thisPanel.removeAttribute('hidden');

    // Update the current step with the interacted tab's index value
    currentStep = index;
  }

  /*****************************************************************************
   * Expects an event from a click listener.
   */

  function clickTab(e) {
    activateTab([...tabItems].indexOf(e.currentTarget));
  }

  /*****************************************************************************
   * Expects an event from a keydown listener.
   */

  function arrowTab(e) {
    const { keyCode, target } = e;

    /**
     * If the current tab has an enabled next/previous sibling, activate it.
     * Otherwise, activate the tab at the beginning/end of the list.
     */

    const targetPrev = target.previousElementSibling
      , targetNext = target.nextElementSibling
      , targetFirst = target.parentElement.firstElementChild
      , targetLast = target.parentElement.lastElementChild;

    const isDisabled = node => node.hasAttribute('aria-disabled');

    switch (keyCode) {
      case 37: // Left arrow
        if (progressForm.contains(targetPrev) && !isDisabled(targetPrev)) {
          activateTab(currentStep - 1);
        } else if (!isDisabled(targetLast)) {
          activateTab(tabItems.length - 1);
        } break;
      case 39: // Right arrow
        if (progressForm.contains(targetNext) && !isDisabled(targetNext)) {
          activateTab(currentStep + 1);
        } else if (!isDisabled(targetFirst)) {
          activateTab(0);
        } break;
    }
  }

  /*****************************************************************************
   * Expects a boolean.
   *
   * Updates the visual state of the progress bar and makes the next tab
   * available for interaction (if there is a next tab).
   */

  // Immediately attach event listeners to the first tab (happens only once)
  tabItems[0].addEventListener('click', clickTab);
  tabItems[0].addEventListener('keydown', arrowTab);

  function handleProgress(isComplete) {
    const currentTab = tabItems[currentStep]
      , nextTab = tabItems[currentStep + 1];

    if (isComplete) {
      currentTab.setAttribute('data-complete', 'true');

      /**
       * Verify that there is, indeed, a next tab before modifying or listening
       * to it. In case we've reached the last item in the tablist.
       */

      if (progressForm.contains(nextTab)) {
        nextTab.removeAttribute('aria-disabled');

        nextTab.addEventListener('click', clickTab);
        nextTab.addEventListener('keydown', arrowTab);
      }

    } else {
      currentTab.setAttribute('data-complete', 'false');
    }
  }

  // Form Interactions

  /*****************************************************************************
   * Returns a function that only executes after a delay.
   *
   */

  const debounce = (fn, delay = 500) => {
    let timeoutID;

    return (...args) => {
      if (timeoutID) {
        clearTimeout(timeoutID);
      }

      timeoutID = setTimeout(() => {
        fn.apply(null, args);
        timeoutID = null;
      }, delay);
    };
  };

  /*****************************************************************************
   * Waits 0.5s before reacting to any input events. This reduces the frequency
   * at which the listener is fired, making the errors less "noisy". Improves
   * both performance and user experience.
   */

  progressForm.addEventListener('input', debounce(e => {
    const { target } = e;

    validateStep(currentStep).then(() => {

      // Update the progress bar (step complete)
      handleProgress(true);

    }).catch(() => {

      // Update the progress bar (step incomplete)
      handleProgress(false);

    });

    // Display or remove any error messages
    reportValidity(target);
  }));

  /****************************************************************************/

  progressForm.addEventListener('click', e => {
    const { target } = e;

    if (target.matches('[data-action="next"]')) {
      validateStep(currentStep).then(() => {

        // Update the progress bar (step complete)
        handleProgress(true);

        // Progress to the next step
        activateTab(currentStep + 1);

      }).catch(invalidFields => {

        // Update the progress bar (step incomplete)
        handleProgress(false);

        // Show errors for any invalid fields
        invalidFields.forEach(field => {
          reportValidity(field);
        });

        // Focus the first found invalid field for the user
        invalidFields[0].focus();

      });
    }

    if (target.matches('[data-action="prev"]')) {

      // Revisit the previous step
      activateTab(currentStep - 1);

    }
  });

  // Form Submission

  function handleSuccess(response) {
    const thankYou = progressForm.querySelector('#progress-form__thank-you');

    // Clear all HTML Nodes that are not the thank you panel
    while (progressForm.firstElementChild !== thankYou) {
      progressForm.removeChild(progressForm.firstElementChild);
    }

    thankYou.removeAttribute('hidden');

    // Logging the response from httpbin for quick verification
    console.log(response);
  }


});

/****************************************************************************/
//SAVE FORM DATA
function saveFormData() {
  var inputs = document.querySelectorAll('input, select, textarea');
  var formData = {};

  inputs.forEach(function (input) {
      if (input.type === "select-one") {
          formData[input.name] = input.selectedIndex;
      } else if (input.type === "checkbox") {
          formData[input.name] = input.checked; 
      } else if (input.type === "file") {
          console.log('File input detected, skipping...');
      } else {
          formData[input.name] = input.value;
      }
  });

  localStorage.setItem('formData', JSON.stringify(formData));
}

function loadFormData() {
  var storedData = localStorage.getItem('formData');

  if (storedData) {
      var formData = JSON.parse(storedData);

      for (var key in formData) {
          if (formData.hasOwnProperty(key)) {
              var inputElement = document.querySelector('[name="' + key + '"]');
              if (inputElement) {
                  if (inputElement.type === "select-one") {
                      inputElement.selectedIndex = formData[key];
                      inputElement.dispatchEvent(new Event('change'));
                  } else if (inputElement.type === "checkbox") {
                      inputElement.checked = formData[key]; 
                  } else if (inputElement.type !== "file") {
                      inputElement.value = formData[key];
                  }
              }
          }
      }
  }
}


window.addEventListener('beforeunload', saveFormData);
window.addEventListener('load', loadFormData);
document.querySelector('[data-action="next"]').addEventListener('click', saveFormData);

document.addEventListener("DOMContentLoaded", function () {
  const incomingGradeSelect = document.getElementById("incomingGrade");

  incomingGradeSelect.addEventListener("change", function () {
      const selectedValue = incomingGradeSelect.value;
  });
});

/****************************************************************************/
/**
 * incoming grade or year level input field
 */
document.getElementById('incomingGrade').addEventListener('change', function() {
  const selectedValue = this.value;
  const additionalFields = document.getElementById('additionalFields');
  const currentProgramField = document.getElementById('currentProgramField');
  const currentProgramInput = document.getElementById('currentProgram');
  
  // clear any existing fields
  additionalFields.innerHTML = '';
  currentProgramInput.value = '';

  // apply grid styles for desktop/laptop
  additionalFields.style.gridTemplateColumns = 'repeat(3, 1fr)';
  additionalFields.style.gap = '20px';

  const gradeLevels = {
    'GradeSeven': ['Grade 5', 'Grade 4', 'Grade 3'],
    'GradeEight': ['Grade 6', 'Grade 5', 'Grade 4'],
    'GradeNine': ['Grade 7', 'Grade 6', 'Grade 5'],
    'GradeTen': ['Grade 8', 'Grade 7', 'Grade 6'],
    'GradeEleven': ['Grade 9', 'Grade 8', 'Grade 7'],
    'GradeTwelve': ['Grade 10', 'Grade 9', 'Grade 8'],
    'FirstYear': ['Grade 11', 'Grade 10', 'Grade 9'],
    'SecondYear': ['Grade 12', 'Grade 11', 'Grade 10'],
    'ThirdYear': ['First Year College', 'Grade 12', 'Grade 11']
  };
  
  //show the current program if they are incoming second year to fourth year
  const collegeYearsWithProgram = ['SecondYear', 'ThirdYear', 'FourthYear'];
  if (collegeYearsWithProgram.includes(selectedValue)) {
    currentProgramField.style.display = 'block';
    currentProgramInput.setAttribute('required', 'required');
  } else {
    currentProgramField.style.display = 'none';
    currentProgramInput.removeAttribute('required');
  }
  
  if (gradeLevels[selectedValue]) {
    for (let i = 0; i < 3; i++) {
      const yearLevelField = document.createElement('div');
      yearLevelField.className = 'form__field';
      yearLevelField.innerHTML = `
        <label for="yearLevel${i + 1}">
          Grade Level
          <span class="text-red-500" style="color: red;">*</span>
        </label>
        <input type="text" id="yearLevel${i + 1}" name="yearLevel[]" 
               value="${gradeLevels[selectedValue][i]}" disabled required
               style="background-color: #f0f0f0; color: #888;">
      `;
      additionalFields.appendChild(yearLevelField);

      // school input field
      const schoolField = document.createElement('div');
      schoolField.className = 'form__field';
      schoolField.innerHTML = `
        <label for="schoolGrade${i + 1}">
          School
          <span class="text-red-500" style="color: red;">*</span>
        </label>
        <input type="text" id="schoolGrade${i + 1}" name="schoolGrade[]" 
               autocomplete="school" required>
      `;
      additionalFields.appendChild(schoolField);

      // general Average input field
      const generalAverageField = document.createElement('div');
      generalAverageField.className = 'form__field';
      generalAverageField.innerHTML = `
        <label for="generalAverage${i + 1}">
          General Average
          <span class="text-red-500" style="color: red;">*</span>
        </label>
        <input type="number" id="generalAverage${i + 1}" name="generalAverage[]" 
               autocomplete="generalAverage" required>
      `;
      additionalFields.appendChild(generalAverageField);
    }
  }
  
  const isFirstYearCollege = selectedValue === 'FirstYear';
    
  // school Application fields
  document.getElementById("schoolApplicationHeader").style.display = isFirstYearCollege ? "block" : "none";
  
  // school Choice fields
  const schoolChoiceFields = ["schoolChoice1", "schoolChoice2", "schoolChoice3"];
  schoolChoiceFields.forEach(field => {
    const fieldElement = document.getElementById(field);
    const fieldContainer = document.getElementById(field + "Field");
    fieldContainer.style.display = isFirstYearCollege ? "block" : "none";
    
    if (isFirstYearCollege) {
      fieldElement.setAttribute("required", "");
      document.querySelector(`label[for="${field}"] span[data-required="true"]`).style.color = "red";
    } else {
      fieldElement.removeAttribute("required");
      document.querySelector(`label[for="${field}"] span[data-required="true"]`).innerHTML = "";
    }
  });

  // preferred Program fields
  document.getElementById("preferredProgramHeader").style.display = isFirstYearCollege ? "block" : "none";
  
  // course Choice fields
  const courseChoiceFields = ["courseChoice1", "courseChoice2", "courseChoice3"];
  courseChoiceFields.forEach(field => {
    const fieldElement = document.getElementById(field);
    const fieldContainer = document.getElementById(field + "Field");
    fieldContainer.style.display = isFirstYearCollege ? "block" : "none";
    
    if (isFirstYearCollege) {
      fieldElement.setAttribute("required", "");
      document.querySelector(`label[for="${field}"] span[data-required="true"]`).style.color = "red";
    } else {
      fieldElement.removeAttribute("required");
      document.querySelector(`label[for="${field}"] span[data-required="true"]`).innerHTML = "";
    }
  });
});
  



/******************************************/
//Total Received Income
const fatherIncomeInput = document.getElementById('fatherIncome');
const motherIncomeInput = document.getElementById('incomeMother');
const supportReceivedInput = document.getElementById('supportReceived');

// Function to format a number with commas as thousand separators
function formatNumberWithCommas(number) {
  return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

// Function to calculate and update the total support received
function updateTotalSupport() {
  const fatherIncome = parseFloat(fatherIncomeInput.value) || 0;
  const motherIncome = parseFloat(motherIncomeInput.value) || 0;
  const totalSupport = fatherIncome + motherIncome;
  supportReceivedInput.value = formatNumberWithCommas(totalSupport.toFixed(2));
}

// Add event listeners to the input elements to trigger the calculation
fatherIncomeInput.addEventListener('input', updateTotalSupport);
motherIncomeInput.addEventListener('input', updateTotalSupport);

/******************************************/
/**
 * SUBMIT BUTTON
 */
const validateAllFields = () => {
  let isValid = true;
  const formFields = document.querySelectorAll('#progress-form input:not([type="hidden"]), #progress-form select, #progress-form textarea');
  formFields.forEach((field) => {
    if (field.type !== 'hidden') {
      const validationResult = getValidationData(field);
      if (!validationResult.isValid) {
        reportError(field, validationResult.message);
        isValid = false;
      } else {
        reportSuccess(field);
      }
    }
  });
  return isValid;
};

const reportError = (field, message) => {
  const existingRedError = field.parentNode.querySelector('.form__error-text');
  if (existingRedError) {
    return;
  }

  const existingBlackError = field.parentNode.querySelector('.error-message:not(.form__error-text)');
  if (existingBlackError) {
    existingBlackError.remove();
  }

  if (!existingRedError) {
    const errorElement = document.createElement('p');
    errorElement.className = 'form__error-text';
    errorElement.textContent = message;
    errorElement.style.color = 'red';
    field.parentNode.appendChild(errorElement);
  }

  field.classList.add('error');
};

const reportSuccess = (field) => {
  field.classList.remove('error');
  const existingErrors = field.parentNode.querySelectorAll('.error-message, .form__error-text');
  existingErrors.forEach(error => error.remove());
};

const style = document.createElement('style');
style.textContent = `
  .error-message:not(.form__error-text) {
    display: none;
  }
`;
document.head.appendChild(style);

const submitButton = document.getElementById('submitButton');
const progressForm = document.getElementById('progress-form');

submitButton.addEventListener('click', (e) => {
  e.preventDefault();
  const isValid = validateAllFields();
  if (isValid) {
    submitButton.textContent = 'Submitting...';
    submitButton.disabled = true;
    const formData = new FormData(progressForm);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    formData.append('_token', csrfToken);

    fetch(screeningPostRoute, {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
    })
      .then((response) => {
        if (!response.ok) {
          return response.json().then(err => { throw err; });
        }
        return response.json();
      })
      .then((data) => {
        if (data.redirect) {
          window.location.href = data.redirect;
        } else {
          window.location.href = verificationRoute;
        }
      })
      .catch((error) => {
        console.error('Error:', error);
        handleSubmissionError(error);
      })
      .finally(() => {
        submitButton.textContent = 'Submit';
        submitButton.disabled = false;
      });
  }
});

const handleSubmissionError = (error) => {
  console.log('Handling submission error:', error);  
  
  if (error.errors) {
    Object.entries(error.errors).forEach(([key, value]) => {
      const field = document.querySelector(`[name="${key}"]`);
      if (field) {
        let errorMessage = Array.isArray(value) ? value[0] : value;
        if (key === 'email' && errorMessage.includes('has already been taken')) {
          errorMessage = 'The email address is already registered. Please use a different email.';
        }
        alert(errorMessage);
        reportError(field, errorMessage);
      }
    });
  } else if (error.message) {
    alert(error.message);
  } else {
    alert('An unexpected error occurred. Please try again.');
  }
};

/******************************************/
/**
 * Toggle Password
 */
const togglePassword = document.querySelector('#togglePassword');
const passwordField = document.querySelector('#passwordField');

togglePassword.addEventListener('click', function() {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    if (this.classList.contains('fa-eye')) {
        this.classList.remove('fa-eye');
        this.classList.add('fa-eye-slash');
    } else {
        this.classList.remove('fa-eye-slash');
        this.classList.add('fa-eye');
    }
});

const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
const confirmPasswordField = document.querySelector('#confirmPasswordField');

toggleConfirmPassword.addEventListener('click', function() {
    const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmPasswordField.setAttribute('type', type);
    if (this.classList.contains('fa-eye')) {
        this.classList.remove('fa-eye');
        this.classList.add('fa-eye-slash');
    } else {
        this.classList.remove('fa-eye-slash');
        this.classList.add('fa-eye');
    }
});

/******************************************/
/**
 * Attendance
 */
document.addEventListener('DOMContentLoaded', function() {
  const attendOrientationSelect = document.getElementById('attend-orientation');
  const orientationDateField = document.getElementById('orientation-date').closest('.form__field');
  const orientationProofField = document.getElementById('orientation-proof').closest('.form__field');
  const orientationDateInput = document.getElementById('orientation-date');
  const orientationProofInput = document.getElementById('orientation-proof');

  // Initially hide the fields
  orientationDateField.style.display = 'none';
  orientationProofField.style.display = 'none';

  attendOrientationSelect.addEventListener('change', function() {
      if (this.value === 'yes') {
          orientationDateField.style.display = 'block';
          orientationProofField.style.display = 'block';
          
          orientationDateInput.setAttribute('required', 'required');
          orientationProofInput.setAttribute('required', 'required');
      } else {
          // Clear data and hide fields
          orientationDateField.style.display = 'none';
          orientationProofField.style.display = 'none';

          orientationDateInput.removeAttribute('required');
          orientationProofInput.removeAttribute('required');
          
          // Clear the values of the inputs when orientation is not attended
          orientationDateInput.value = '';
          orientationProofInput.value = '';
      }
  });
});
