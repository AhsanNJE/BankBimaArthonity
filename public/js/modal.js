document.addEventListener('DOMContentLoaded', function () {
    // Get all elements with the class 'open-modal'
    var openModalBtns = document.querySelectorAll('.open-modal');

    // Attach event listeners to each button
    openModalBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var modalId = btn.getAttribute('data-modal-id');
            var modal = document.getElementById(modalId);

            if (modal) {
                modal.style.display = 'block';
            }
        });
    });

    // Attach event listeners to close buttons
    var closeBtns = document.querySelectorAll('.close-modal');
    closeBtns.forEach(function (closeBtn) {
        closeBtn.addEventListener('click', function () {
            var modalId = closeBtn.getAttribute('data-modal-id');
            var modal = document.getElementById(modalId);

            if (modal) {
                modal.style.display = 'none';
            }
        });
    });

    // Close modal if clicked outside the modal
    window.addEventListener('click', function (event) {
        if (event.target.classList.contains('modal-container')) {
            event.target.style.display = 'none';
        }
    });
});