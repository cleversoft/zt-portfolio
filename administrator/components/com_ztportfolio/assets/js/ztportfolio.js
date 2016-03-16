(function (w) {
    if (typeof (w.jQuery) !== 'undefined') {
        var $ = w.jQuery;
    } else {
        console.log('jQuery is not defined');
        return false;
    }
    $(document).ready(function () {
        var $inputItems = $('#ztportfolioPropertiesEditor input.ztportfolio-property');
        $inputItems.each(function () {
            $(this).val(atob($(this).val()));
        });
        $('.bootstrap-datepicker').datepicker({
            onSelect: function(){
                $inputItems.trigger('keyup');
            }
        });

        var data = [];
            $inputItems.each(function () {
                data.push({
                    name: $(this).data('name'),
                    type: $(this).data('type'),
                    value: btoa($(this).val())
                });
            });
            $('#ztportfolioPropeties').val(JSON.stringify(data));
            
        $inputItems.keyup(function () {
            var data = [];
            $inputItems.each(function () {
                data.push({
                    name: $(this).data('name'),
                    type: $(this).data('type'),
                    value: btoa($(this).val())
                });
            });
            $('#ztportfolioPropeties').val(JSON.stringify(data));
            console.log(JSON.stringify(data));
        });
    });
})(window);