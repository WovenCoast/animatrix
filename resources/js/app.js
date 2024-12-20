import * as Popper from '@popperjs/core'
window.Popper = Popper
import 'bootstrap'

import $ from 'jquery'
window.jQuery = window.$ = $

// file upload input deps
import swal from 'sweetalert2'
window.Swal = swal

// cool lil toast
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});
window.Toast = Toast;

// wysiwyg deps
// import tinymce from 'tinymce';
// tinymce.init({
//     selector: '.wysiwyg',
//     menubar: false,
//     plugins: [
//         'autolink',
//         'link',
//         'lists',
//         'directionality',
//         'code',
//         'visualchars',
//         'quickbars'
//     ],
//     toolbar: [
//         'undo redo | styles bold italic | bullist numlist | alignleft aligncenter alignright alignjustify alignnone |' +
//         ' link unlink | ltr rtl | outdent indent | code '
//     ],
//     quickbars_insert_toolbar: false
// });

// date picker deps
import flatpickr from "flatpickr";
(function($) {
    // Check if jQuery and Flatpickr are loaded
    if (!$ || !flatpickr) {
        console.error('jQuery or Flatpickr is not loaded');
        return;
    }

    // Define the jQuery plugin
    $.fn.flatpickr = function(options) {
        // If no arguments, return the first element's flatpickr instance
        if (arguments.length === 0) {
            const instance = this.data('flatpickr');
            if (instance) return instance;
        }

        // Iterate through each element
        return this.each(function() {
            // Destroy existing instance if it exists
            const existingInstance = $(this).data('flatpickr');
            if (existingInstance) {
                existingInstance.destroy();
            }

            // Create new Flatpickr instance
            const fp = flatpickr(this, options);

            // Store the instance on the element
            $(this).data('flatpickr', fp);
        });
    };

    // Optional: Add a method to get the flatpickr instance
    $.fn.getFlatpickr = function() {
        return this.data('flatpickr');
    };
})(jQuery);

import {dateInput, fileUploadInput, csrfAdder} from "@javaabu/js-utilities";
csrfAdder.init();
dateInput.init();
fileUploadInput.init();
// fileUploadInput();

import './bootstrap';

import axios from 'axios';
$(() => {
    const viewButtons = document.getElementsByClassName('view-button');
    Array.from(viewButtons).forEach(button => {
        button.addEventListener('click', (e) => {
            const redirect = e.target.closest('.view-button').dataset.redirect;
            window.location.href = redirect;
        })
    })

    const editButtons = document.getElementsByClassName('edit-button');
    Array.from(editButtons).forEach(button => {
        button.addEventListener('click', (e) => {
            const redirect = e.target.closest('.edit-button').dataset.redirect;
            window.location.href = redirect;
        })
    })

    const deleteButtons = document.getElementsByClassName('delete-button');
    Array.from(deleteButtons).forEach(deleteButton => {
        deleteButton.addEventListener('click', async (e) => {
            e.preventDefault();
            const articleId = e.target.closest(".delete-button").dataset.article;
            const { isConfirmed } = await Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to delete this article?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '--primary',
                // cancelButtonColor: '#ffffff',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            });

            if (isConfirmed) {
                const response = await axios.delete(`/articles/${articleId}`);
                if (response.status === 200) {
                    window.location.href = "/";
                }
            }
        });
    })
})
