document.addEventListener('DOMContentLoaded', function () {
    // restore the last active tab from session storage
    let lastTab = sessionStorage.getItem('lastTab');
    if (lastTab) {
        let tabLink = document.querySelector(`[data-bs-target="${lastTab}"]`);
        if (tabLink) {
            let tab = new bootstrap.Tab(tabLink);
            tab.show();
        }
    }

    // save the active tab to session storage on tab change
    let tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
    tabLinks.forEach(function (tabLink) {
        tabLink.addEventListener('shown.bs.tab', function (event) {
            let activeTab = event.target.getAttribute('data-bs-target');
            sessionStorage.setItem('lastTab', activeTab);
        });
    });

    // initialize Quill editor for each tab
    var toolbarOptions = [
        ['bold', 'italic', 'underline'], 
        [{ 'list': 'ordered' }, { 'list': 'bullet' }], 
        ['link'], 
        ['clean'] 
    ];

    var quillConfig = {
        theme: 'snow',
        modules: {
            toolbar: toolbarOptions
        },
        formats: ['bold', 'italic', 'underline', 'list', 'bullet', 'link']
    };
    
    // Create editors for all tabs
    var editors = {
        'under-review': new Quill('#under-review-editor-container', quillConfig),
        'shortlisted': new Quill('#shortlisted-editor-container', quillConfig),
        'interview': new Quill('#interview-editor-container', quillConfig),
        'house-visitation': new Quill('#house-visitation-editor-container', quillConfig),
        'decline': new Quill('#decline-editor-container', quillConfig),
        'approved': new Quill('#approved-editor-container', quillConfig)
    };

    // function to set the hidden input value from the editor's content
    function setHiddenInput(editor, inputId) {
        var input = document.getElementById(inputId);
        input.value = editor.root.innerHTML;
    }

    // set hidden input values and handle form submissions
    Object.keys(editors).forEach(function (key) {
        var editor = editors[key];
        var inputId = key.replace('-', '_') + '_input';

        // update hidden input on text change
        editor.on('text-change', function () {
            setHiddenInput(editor, inputId);
        });

        // form submission handling
        var form = document.getElementById(key + 'Form');
        if (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                setHiddenInput(editor, inputId);
                this.submit();
            });
        }
    });
});
