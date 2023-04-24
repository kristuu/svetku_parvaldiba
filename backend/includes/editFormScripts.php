<script>
    const popovers = <?=json_encode($restrictionPopovers)?>;
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    popoverTriggerList.forEach((inputField) => {
        inputField.setAttribute("data-bs-trigger", "hover focus");
        inputField.setAttribute("data-bs-title", popovers["Title"]);
        inputField.setAttribute("data-bs-content", popovers[inputField.id]);
        inputField.setAttribute("data-bs-html", "true");
    });
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>
<script>
    // disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
<script>
    function addInputGroupClass() {
        const screenWidth = window.innerWidth;
        const inputGroups = document.querySelectorAll('.input-group');
        const buttons = document.querySelectorAll('.btn');

        if (screenWidth < 1200) {
            inputGroups.forEach((inputGroup) => {
                inputGroup.classList.add('input-group-sm');
            });
            buttons.forEach((button) => {
                button.classList.add('btn-sm');
            });
        } else {
            inputGroups.forEach((inputGroup) => {
                inputGroup.classList.remove('input-group-sm');
            });
            buttons.forEach((button) => {
                button.classList.remove('btn-sm');
            });
        }
    }

    window.addEventListener('resize', addInputGroupClass);

    // Call addInputGroupClass on page load to apply the class initially
    addInputGroupClass();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js" integrity="sha512-6lplKUSl86rUVprDIjiW8DuOniNX8UDoRATqZSds/7t6zCQZfaCe3e5zcGaQwxa8Kpn5RTM9Fvl3X2lLV4grPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>