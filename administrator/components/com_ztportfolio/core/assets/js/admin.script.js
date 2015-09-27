(function (w, $) {

    var zt = w.zt;

    w.reloadCategories = function () {
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=categories.reload',
            data: {
                zt_cmd: 'ajax'
            }
        }, true);
    };

    w.headerRemove = function (thisPtr) {
        $(thisPtr).closest('div#zt-portfolio-element').fadeOut('slow', function () {
            $(this).remove();
        });
    };

    w.headerAdd = function () {
        var $parent = $('#zt-portfolio-header-editor');
        var name = $parent.find('#header-name').val();
        if (name === '') {
            return false;
        }
        var type = $parent.find('#header-type').val();
        var value = $parent.find('#header-default').val();
        var html = '<div id="zt-portfolio-element" data-name="' + name + '" data-type="' + type + '" data-value="' + value + '">';
        html += name;
        html += '<button onclick="headerRemove(this);" class="btn btn-mini btn-danger pull-right">x</button></div>';
        $('#zt-portfolio-container').append(html);
        $parent.find('input').val('');
        $parent.find('select').val('text');
    };

    w.categorySave = function (id) {
        if ($('#category-name').val() === '') {
            return false;
        }
        var $elements = $('div#zt-portfolio-container').find('div#zt-portfolio-element');
        var data = [];
        $elements.each(function () {
            var elementData = {};
            elementData.name = $(this).data('name');
            elementData.type = $(this).data('type');
            elementData.value = $(this).data('value');
            data.push(elementData);
        });

        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=categories.save',
            data: {
                name: $('#category-name').val(),
                header: JSON.stringify(data),
                id: id,
                zt_cmd: 'ajax'
            }
        }, true);
    };

    w.categoryCreate = function () {
        if ($('#category-name').val() === '') {
            return false;
        }
        var $elements = $('div#zt-portfolio-container').find('div#zt-portfolio-element');
        var data = [];
        $elements.each(function () {
            var elementData = {};
            elementData.name = $(this).data('name');
            elementData.type = $(this).data('type');
            elementData.value = $(this).data('value');
            data.push(elementData);
        });

        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=categories.create',
            data: {
                name: $('#category-name').val(),
                header: JSON.stringify(data),
                zt_cmd: 'ajax'
            }
        }, true);
    };

    w.categoryDelete = function (id) {
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=categories.delete',
            data: {
                zt_cmd: 'ajax',
                id: id
            }
        }, true);
    };

    w.categoryLoadEditor = function (id) {
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=categories.loadEditor',
            data: {
                zt_cmd: 'ajax',
                id: id
            }
        }, true);
    };


    w.categoryClear = function () {
        var $editor = $('#zt-portfolio-header-editor');
        $editor.find('input').val('');
        $editor.find('select').val('text');
        $('#zt-portfolio-container').html('');
        $('#category-name').val('');
    };


    w.portfolioCreate = function () {
        var $elements = $('div#portfolio-header-edit').find('input#portfolio-header-element');
        var data = [];
        $elements.each(function () {
            var elementData = {};
            elementData.name = $(this).data('name');
            elementData.type = $(this).data('type');
            elementData.value = $(this).val();
            data.push(elementData);
        });

        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=data.create',
            data: {
                title: $('#portfolio-title').val(),
                thumbnail: $('#portfolio-thumbnail').val(),
                category: $('#portfolio-category').val(),
                header: JSON.stringify(data),
                content: $('#portfolio-content_ifr').contents().find('#tinymce').html(),
                zt_cmd: 'ajax'
            }
        }, true);
    };
    
    w.portfolioSave = function (id) {
        var $elements = $('div#portfolio-header-edit').find('input#portfolio-header-element');
        var data = [];
        $elements.each(function () {
            var elementData = {};
            elementData.name = $(this).data('name');
            elementData.type = $(this).data('type');
            elementData.value = $(this).val();
            data.push(elementData);
        });

        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=data.save',
            data: {
                id: id,
                title: $('#portfolio-title').val(),
                thumbnail: $('#portfolio-thumbnail').val(),
                category: $('#portfolio-category').val(),
                header: JSON.stringify(data),
                content: $('#portfolio-content_ifr').contents().find('#tinymce').html(),
                zt_cmd: 'ajax'
            }
        }, true);
    };
    
    w.portfolioCancel = function(){
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=data.cancel',
            data: {
                zt_cmd: 'ajax'
            }
        }, true);
    };
    
    w.portfolioLoadHeader = function(thisPtr){
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=data.loadHeader',
            data: {
                id: $(thisPtr).val(),
                zt_cmd: 'ajax'
            }
        }, true);
    };
    
    w.portfolioDelete = function (id) {
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=data.delete',
            data: {
                zt_cmd: 'ajax',
                id: id
            }
        }, true);
    };
    
})(window, jQuery);