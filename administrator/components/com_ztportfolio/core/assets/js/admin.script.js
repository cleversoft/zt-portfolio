(function ($) {
    $(document).ready(function () {
        
        /**
         * Remove header
         */
        $('#zt-portfolio-container').on('click', '#header-remove', function () {
            $(this).closest('div#zt-portfolio-element').fadeOut('slow', function () {
                $(this).remove();
            });
        });

        /**
         * Add header
         */
        $('#zt-portfolio-header-editor #header-add').on('click', function () {
            var $parent = $('#zt-portfolio-header-editor');
            var name = $parent.find('#header-name').val();
            if(name === '')return false;
            var type = $parent.find('#header-type').val();
            var value = $parent.find('#header-default').val();
            var html = '<div id="zt-portfolio-element" data-name="' + name + '" data-type="' + type + '" data-value="' + value + '">';
            html += name;
            html += '<button id="header-remove" class="btn btn-mini pull-right">x</button></div>';
            $('#zt-portfolio-container').append(html);
            $parent.find('input').val('');
            $parent.find('select').val('text');
        });

        /**
         * Create category
         */
        $('#zt-portfolio-category-tools').on('click', '#category-create', function () {
            
            var $elements = $('div#zt-portfolio-container').find('div#zt-portfolio-element');
            var data = [];
            $elements.each(function(){
                var elementData = {};
                elementData.name = $(this).data('name');
                elementData.type = $(this).data('type');
                elementData.value = $(this).data('value');
                data.push(elementData);
            });
            
            zt.ajax.request({
                url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=categories.create',
                data:{
                    name: $('#category-name').val(),
                    header: JSON.stringify(data),
                    zt_cmd: 'ajax'
                }
            }, true);
            //console.log(JSON.stringify(data));
            
        });

        /**
         * Clear category
         */
        $('#zt-portfolio-category-tools').on('click', '#category-clear', function () {
            var $editor = $('#zt-portfolio-header-editor');
            $editor.find('input').val('');
            $editor.find('select').val('text');
            $('#zt-portfolio-container').html('');
            $('#category-name').val('');
        });
        
        
    });
})(jQuery);