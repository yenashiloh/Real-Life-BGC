console.clear();

function ready(fn) {
  if (document.readyState === 'complete' || document.readyState === 'interactive') {
    setTimeout(fn, 1);
    document.removeEventListener('DOMContentLoaded', fn);
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
}

ready(function () {

  // Global Constants

  const progressForm = document.getElementById('progress-form');

  const tabItems = progressForm.querySelectorAll('[role="tab"]')
    , tabPanels = progressForm.querySelectorAll('[role="tabpanel"]');

  let currentStep = 0;

  // Form Validation

  /*****************************************************************************
   * Expects a string.
   *
   * Returns a boolean if the provided value *reasonably* matches the pattern
   * of a US phone number. Optional extension number.
   */

  const isValidPhone = val => {
    const regex = new RegExp(/^(?:(?:\+|0{0,2})63|0)?\s?(\d{3})[-.\s]?(\d{3})[-.\s]?(\d{4})$/);

    return regex.test(val);
  };

  /*****************************************************************************
   * Expects a string.
   *
   * Returns a boolean if the provided value *reasonably* matches the pattern
   * of a real email address.
   *
   * NOTE: There is no such thing as a perfect regular expression for email
   *       addresses; further, the validity of an email address cannot be
   *       verified on the front end. This is the closest we can get without
   *       our own service or a service provided by a third party.
   *
   * RFC 5322 Official Standard: https://emailregex.com/
   */

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
  * Birthdate Validation
  */
  const validateDate = field => {
    const val = field.value.trim();

    if (val === '' && field.required) {
      return {
        isValid: false,
      };
    } else {
      const currentDate = new Date();
      const selectedDate = new Date(val);
      const ageInYears = (currentDate - selectedDate) / (365 * 24 * 60 * 60 * 1000);

      if (ageInYears < 10 || ageInYears > 25) {
        return {
          isValid: false,
          message: 'Should not be more than 25 years of age upon admission'
        };
      }

      return {
        isValid: true
      };
    }
  };

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

  // const validateNumber = field => {
  //   const val = field.value.trim();

  //   if (val === '' && field.required) {
  //     return {
  //       isValid: false
  //     };
  //   } else {

  //     return {
  //       isValid: true
  //     };
  //   }
  // };

  const validatePassword = field => {
    const val = field.value.trim();

    if (val === '' && field.required) {
      return {
        isValid: false,
      };
    }

    // Check for lowercase letter
    const hasLowercase = /[a-z]/.test(val);

    // Check for capital letter
    const hasUppercase = /[A-Z]/.test(val);

    // Check for number
    const hasNumber = /\d/.test(val);

    // Check for minimum length of 8 characters
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



  // const validateNumber = field => {
  //   const val = field.value.trim();

  //   if (val === '' && field.required) {
  //       return {
  //           isValid: false,
  //           message: 'This field is required.'
  //       };
  //   } else {
  //       const numericVal = parseFloat(val);

  //       if (isNaN(numericVal) || numericVal < 88 || numericVal > 100) {
  //           return {
  //               isValid: false,
  //               message: 'GWA must be 88% to100% to qualify the scholarship'
  //           };
  //       }

  //       return {
  //           isValid: true
  //       };
  //   }
  // };
  // const validateFile = (field) => {
  //   const val = field.value.trim();
  //   const isValid = !(val === '' && field.required);

  //   return {
  //     isValid
  //   };
  // };

  //   const validateCheckbox = field => {
  //     if (field.checked) {
  //         return {
  //             isValid: true
  //         };
  //     } else {
  //         return {
  //             isValid: false,
  //             message: 'please check the box to proceed.'
  //         };
  //     }
  // };


  /*****************************************************************************
   * Expects a Node (select).
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

  /*****************************************************************************
   * Expects a Node (fieldset).
   */

  // Update the validateGroup function to set required attribute to the checkbox
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

  /*****************************************************************************
   * Expects a Node (input[type="radio"] or input[type="checkbox"]).
   */

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
      return true;
    };

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

    const validateMapAddress = field => {
      const val = field.value.trim();
      if (val === '' && field.required) {
        return {
          isValid: false,
        };
      } else if (val !== '' && !isImageFile(val)) {
        return {
          isValid: false,
          message: 'Please upload JPG, JPEG, or PNG files only for the map address.'
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

  const getValidationData = (field) => {
  switch (field.tagName.toLowerCase()) {
        case 'input':
      switch (field.type) {
        case 'text':
        case 'number':
        case 'email':
          if (field.name === 'latestAverage') {
            // Get the selected grade level
            const selectedGrade = document.getElementById('incomingGrade').value;
            // Only validate if the selected grade is Grade 7 to 10
            if (selectedGrade === 'GradeSeven' || selectedGrade === 'GradeEight' || selectedGrade === 'GradeNine' || selectedGrade === 'GradeTen') {
              if (field.value.trim() === '') {
                return {
                  isValid: false,
                  message: 'Please complete this required field.'
                };
              }
              return validateLatestAverage(field, 88, 100);
            } else {
              return { isValid: true }; // Skip validation for other grades
            }
          }   
          if (field.name === 'equivalentGrade') {
            // Get the selected grade level
            const selectedGrade = document.getElementById('incomingGrade').value;
            // Only validate the number range if the selected grade is Grade 12 or higher
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
          return validateDate(field);
        case 'tel':
          return validatePhone(field);
        case 'checkbox':
        case 'radio':
          return validateChoice(field);
        case 'file':
          if (field.name === 'reportCard') {
            return validateReportCard(field);
          } else if (field.name === 'mapAddress') {
            return validateMapAddress(field);
          } else if (field.name === 'ReportCard') { 
            return validateReportCard(field); 
          } else {
            throw new Error(`The provided file input field with name '${field.name}' is not supported in this form.`);
          }
          
          default:
            throw new Error(`The provided field type '${field.tagName}:${field.type}' is not supported in this form.`);
        }
        case 'textarea':
          if (field.name === 'noteAddress') {
            if (field.value.trim() === '') {
              return {
                isValid: false,
                message: 'Please provide instructions on how to go to your place if you will be coming from Every Nation BGC.'
              };
            }
            return { isValid: true };
          } else {
            throw new Error(`The provided field type 'TEXTAREA:${field.name}' is not supported in this form.`);
          }
        case 'select':
          return validateSelect(field);
        default:
          throw new Error(`The provided field type '${field.tagName}' is not supported in this form.`);
      }
    };
  
  
  /*****************************************************************************
   * Expects a Node (field or fieldset).
   *
   * Returns the field's overall validity based on conditions set within
   * `getValidationData()`.
   */

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
// Add event listener for checkbox click event
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
   * https://davidwalsh.name/javascript-debounce-function
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

  /*****************************************************************************
   * Returns the user's IP address.
   */

//   async function getIP(url = 'https://api.ipify.org?format=json') {
//     return new Promise((resolve, reject) => {
//         const callbackName = 'jsonpCallback' + Math.round(100000 * Math.random());
//         window[callbackName] = (data) => {
//             delete window[callbackName];
//             resolve(data);
//         };

//         const script = document.createElement('script');
//         script.src = url + '&callback=' + callbackName;
//         script.async = true;
//         script.onerror = (error) => {
//             reject(error);
//         };

//         document.head.appendChild(script);
//     });
// }

//   /*****************************************************************************
//    * POSTs to the specified endpoint.
//    */

//   async function postData(url = '', data = {}) {
//     const response = await fetch(url, {
//       method: 'POST',
//       headers: {
//         'Content-Type': 'application/json'
//       },
//       body: JSON.stringify(data)
//     });

//     if (!response.ok) {
//       throw new Error(response.statusText);
//     }

//     return response.json();
//   }

//   document.getElementById("submitButton").addEventListener("click", function() {
//     const formData = {
//         // Collect form data here
//     };

//     // Replace 'https://httpbin.org/post' with your actual endpoint URL
//     postData('https://httpbin.org/post', formData)
//         .then(data => {
//             console.log(data); // Log response data to the console
//             // Handle response data as needed
//         })
//         .catch(error => {
//             console.error('Error:', error); // Log any errors to the console
//             // Handle errors as needed
//         });
// });


  /****************************************************************************/

  // function disableSubmit() {
  //   const submitButton = progressForm.querySelector('[type="submit"]');

  //   if (progressForm.contains(submitButton)) {

  //     // Update the state of the submit button
  //     submitButton.setAttribute('disabled', '');
  //     submitButton.textContent = 'Submitting...';

  //   }
  // }

  /****************************************************************************/

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

  /****************************************************************************/

//   function handleError(error) {
//     const submitButton = progressForm.querySelector('[type="submit"]');

//     if (progressForm.contains(submitButton)) {
//       const errorText = document.createElement('p');

//       // Reset the state of the submit button
//       submitButton.removeAttribute('disabled');
//       submitButton.textContent = 'Submit';

//       // Display an error message for the user
//       errorText.classList.add('m-0', 'form__error-text');
//       errorText.textContent = `Sorry, your submission could not be processed.
//         Please try again. If the issue persists, please contact our support
//         team. Error message: ${error}`;

//       submitButton.parentElement.prepend(errorText);
//     }
//   }

//   /****************************************************************************/
//   function handleError(errorMessage, errorStack) {
//     console.error("An error occurred: ", errorMessage);
//     console.error("Error stack trace: ", errorStack);
//     // Additional error handling logic can be added here
// }

//  progressForm.addEventListener('submit', e => {
//     // Prevent the form from submitting
//     e.preventDefault();

//     // Get the API endpoint using the form action attribute
//     const form = e.currentTarget;
//     const API = new URL(form.action);

//     validateStep(currentStep)
//         .then(() => {
//             // Indicate that the submission is working
//             disableSubmit();

//             // Prepare the data
//             const formData = new FormData(form);
//             const formTime = new Date().getTime();
//             const formFields = [];

//             // Format the data entries
//             for (const [name, value] of formData) {
//                 formFields.push({
//                     'name': name,
//                     'value': value
//                 });
//             }

//             // Get the user's IP address (for fun)
//             // Build the final data structure, including the IP
//             // POST the data and handle success or error
//             getIP().then(response => {
//                 return {
//                     'fields': formFields,
//                     'meta': {
//                         'submittedAt': formTime,
//                         'ipAddress': response.ip
//                     }
//                 };
//             })
//             .then(data => postData(API, data))
//             .then(response => {
//                 setTimeout(() => {
//                     handleSuccess(response)
//                 }, 5000); // An artificial delay to show the state of the submit button
//             })
//             .catch(error => {
//                 // Pass error message and stack trace to handleError function
//                 handleError(error.message, error.stack);
//             });

//         })
//         .catch(invalidFields => {
//             // Ensure invalidFields is an array
//             if (Array.isArray(invalidFields)) {
//                 // Show errors for any invalid fields
//                 invalidFields.forEach(field => {
//                     reportValidity(field);
//                 });

//                 // Focus the first found invalid field for the user
//                 invalidFields[0].focus();
//             } else {
//                 // Handle the case when invalidFields is not an array
//                 console.error("Invalid fields data structure is not an array:", invalidFields);
//             }
//         });
// });


});

/****************************************************************************/
//SAVE FORM DATA
function saveFormData() {
  var inputs = document.querySelectorAll('input:not([type="file"]), select');
  var formData = {};

  inputs.forEach(function (input) {
      if (input.type === "select-one") {
          formData[input.name] = input.selectedIndex;
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
                  } else {
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

//specific drop down input field
document.addEventListener("DOMContentLoaded", function () {
  const incomingGradeSelect = document.getElementById("incomingGrade");

  incomingGradeSelect.addEventListener("change", function () {
      const selectedValue = incomingGradeSelect.value;
  });
});

/****************************************************************************/
document.getElementById('incomingGrade').addEventListener('change', function() {
  const toggleDisplay = (field, input, show, required) => {
    if (field && input) {
      field.style.display = show ? 'block' : 'none';
      if (required) {
        input.setAttribute('required', 'required');
      } else {
        input.removeAttribute('required');
        input.value = '';
      }
    }
  };

  const grade = this.value;
  const isUpperGrade = grade === 'GradeTwelve' || grade === 'FirstYear' || grade === 'SecondYear' || grade === 'ThirdYear';
  const isFirstYear = grade === 'FirstYear';

  toggleDisplay(document.getElementById('currentProgramField'), document.getElementById('currentProgram'), isUpperGrade, isUpperGrade);
  toggleDisplay(document.getElementById('latestAverageField'), document.getElementById('latestAverage'), !isUpperGrade, !isUpperGrade);
  toggleDisplay(document.getElementById('latestGWAField'), document.getElementById('latestGWA'), isUpperGrade, isUpperGrade);
  toggleDisplay(document.getElementById('equivalentGradeField'), document.getElementById('equivalentGrade'), isUpperGrade, isUpperGrade);

  document.getElementById('scopeGWA-label').innerHTML = `Scope of Latest ${isUpperGrade ? 'GWA' : 'General Average'} <span data-required="true" aria-hidden="true"></span><span style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;"> Ex. ${isUpperGrade ? '1st Semester' : '1st Grading'}</span>`;

  const schoolFields = ['schoolChoice1Field', 'schoolChoice2Field', 'schoolChoice3Field'];
  const schoolInputs = ['schoolChoice1', 'schoolChoice2', 'schoolChoice3'];
  const programFields = ['courseChoice1Field', 'courseChoice2Field', 'courseChoice3Field'];
  const programInputs = ['courseChoice1', 'courseChoice2', 'courseChoice3'];

  schoolFields.forEach((field, i) => {
    const fieldElem = document.getElementById(field);
    const inputElem = document.getElementById(schoolInputs[i]);
    toggleDisplay(fieldElem, inputElem, isFirstYear, isFirstYear);
  });

  programFields.forEach((field, i) => {
    const fieldElem = document.getElementById(field);
    const inputElem = document.getElementById(programInputs[i]);
    toggleDisplay(fieldElem, inputElem, isFirstYear, isFirstYear);
  });

  const schoolHeader = document.getElementById('schoolApplicationHeader');
  const programHeader = document.getElementById('preferredProgramHeader');

  if (schoolHeader && programHeader) {
    schoolHeader.style.display = isFirstYear ? 'block' : 'none';
    programHeader.style.display = isFirstYear ? 'block' : 'none';
  }

  if (!grade) {
    // If no grade is selected, hide the fields related to school and program
    const schoolFields = ['schoolChoice1Field', 'schoolChoice2Field', 'schoolChoice3Field'];
    const programFields = ['courseChoice1Field', 'courseChoice2Field', 'courseChoice3Field'];

    schoolFields.forEach((field) => {
      const fieldElem = document.getElementById(field);
      if (fieldElem) {
        fieldElem.style.display = 'none';
      }
    });

    programFields.forEach((field) => {
      const fieldElem = document.getElementById(field);
      if (fieldElem) {
        fieldElem.style.display = 'none';
      }
    });
  }
});

document.getElementById('incomingGrade').dispatchEvent(new Event('change')); 



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





