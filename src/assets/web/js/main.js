function copyToClipboard(text) {
    text = text.replace(/<br>/g, '\n').replace(/&lt;/g, '<').replace(/&gt;/g, '>');
    navigator.clipboard.writeText(text);
}

$(document).ready(function () {
    hljs.highlightAll();
    $("form").submit(function (event) {
        event.preventDefault();
        let $form = $(this);
        let formSubmitButton = $form.find('.input-group button[type="submit"]');
        formSubmitButton.prop('disabled', true);
        let alert = $form.next('.alert-message');
        let alertStatus = alert.find('.alert');
        let alertText = alertStatus.find('.text');
        let alertIconSuccess = alertStatus.find('svg[aria-label="Success:"]');
        let alertIconDanger = alertStatus.find('svg[aria-label="Danger:"]');
        alert.hide();
        alertIconSuccess.hide();
        alertIconDanger.hide();
        alertText.text();
        let codeBlockSection = $form.nextAll('.code-block-section').first();
        codeBlockSection.hide();
        let url = $form.attr('action');
        let formData = $form.serializeArray();
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            dataType: "JSON"
        }).done(function (response) {
            if (response.hasOwnProperty('message')) {
                alertText.html(response.message);
            }
            if (response.hasOwnProperty('status')) {
                if (response.status) {
                    alertStatus.removeClass('alert-danger').addClass('alert-success');
                    alertIconDanger.hide();
                    alertIconSuccess.show();
                } else {
                    alertStatus.removeClass('alert-success').addClass('alert-danger');
                    alertIconSuccess.hide();
                    alertIconDanger.show();
                }
                alert.show();
            }
            if (response.hasOwnProperty('data') && response.data !== null) {
                let codeBlock = codeBlockSection.find('.code-block-content .code-block-pre code');
                codeBlock.html(response.data);
                codeBlockSection.show();
            }
            formSubmitButton.prop('disabled', false);
        });
    });
    //Copy to clipboard button with tooltip text
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    $(".btn-copy-clipboard").on('click', function (e) {
        var $this = $(this)
        const tooltipInstance = bootstrap.Tooltip.getInstance($this);
        copyToClipboard($this.parents('.code-block-section').find('.code-block-content code').html());
        tooltipInstance.setContent({'.tooltip-inner': 'Copied!'});
        $this.tooltip("show");
        setTimeout(function () {
            $this.tooltip("hide");
            tooltipInstance.setContent({'.tooltip-inner': $this.attr('aria-label')});
        }, 2500);
        e.preventDefault();
    });
});