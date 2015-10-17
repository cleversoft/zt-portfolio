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
    
    w.categoryShowModal = function(){
        $('#zt-portfolio-create-category').modal('show');
    };
    
    w.categoryReloadHeader = function(){
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=categories.reloadHeader',
            data: {
                zt_cmd: 'ajax',
                id: $('#category-name').val()
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

    w.categorySave = function(){
        name = atob(name);
        if ($('#zt-portfolio-edit-category #category-name').val() === '') {
            return false;
        }
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=categories.save',
            data: {
                name: $('#zt-portfolio-edit-category #category-name').val(),
                id: $('#zt-portfolio-edit-category #category-id').val(),
                zt_cmd: 'ajax'
            }
        }, true);
    };
    
    w.categoryCreate = function () {
        if ($('#category-name').val() === '') {
            return false;
        }
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=categories.create',
            data: {
                name: $('#category-name').val(),
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
    
    w.portfolioPublish = function(){
        var $categoriesEl = $('#zt-portfolio-portfolios-list tbody').find('input:checked');
        var categories = [];
        $categoriesEl.each(function () {
            categories.push($(this).val());
        });
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=data.updateStatus',
            data: {
                zt_cmd: 'ajax',
                portfolios: categories.toString(),
                status: 2
            }
        }, true);
    };
    
    w.portfolioUnpublish = function(){
        var $categoriesEl = $('#zt-portfolio-portfolios-list tbody').find('input:checked');
        var categories = [];
        $categoriesEl.each(function () {
            categories.push($(this).val());
        });
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=data.updateStatus',
            data: {
                zt_cmd: 'ajax',
                portfolios: categories.toString(),
                status: 1
            }
        }, true);
    };
    
    w.categoryPublish = function(){
        var $categoriesEl = $('#zt-portfolio-categories-list tbody').find('input:checked');
        var categories = [];
        $categoriesEl.each(function () {
            categories.push($(this).val());
        });
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=categories.updateStatus',
            data: {
                zt_cmd: 'ajax',
                categories: categories.toString(),
                status: 5
            }
        }, true);
    };
    
    w.categoryUnpublish = function(){
        var $categoriesEl = $('#zt-portfolio-categories-list tbody').find('input:checked');
        var categories = [];
        $categoriesEl.each(function () {
            categories.push($(this).val());
        });
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=categories.updateStatus',
            data: {
                zt_cmd: 'ajax',
                categories: categories.toString(),
                status: 10
            }
        }, true);
    };
    
    w.editCategory = function(id, name){
        $('#zt-portfolio-edit-category #category-id').val(id);
        $('#zt-portfolio-edit-category #category-name').val(atob(name));
        $('#zt-portfolio-edit-category').modal('show');
    };

    w.categoryClear = function () {
        var $editor = $('#zt-portfolio-header-editor');
        $editor.find('input').val('');
        $editor.find('select').val('text');
        $('#zt-portfolio-container').html('');
        $('#category-name').val('');
    };
    
    w.propertySave = function (id) {
        var ajaxData = {
                name: $('#property-name').val(),
                type: $('#property-type').val(),
                value: $('#property-value').val(),
                zt_cmd: 'ajax'
            };
        if(typeof(id) !== 'undefined'){
            ajaxData.id = id|0;
        }
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=properties.save',
            data: ajaxData
        }, true);
    };
    
    w.propertyDelete = function (id) {
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=properties.delete',
            data: {
                zt_cmd: 'ajax',
                id: id
            }
        }, true);
    };

    w.portfolioCreate = function () {
        var $categoriesEl = $('div#category-selector').find('input:checked');
        var categories = [];
        $categoriesEl.each(function () {
            categories.push($(this).val());
        });
        var $propertiesEl = $('div#property-selector').find('input:checked');
        var properties = [];
        $propertiesEl.each(function () {
            var elementData = {};
            elementData.name = $(this).data('name');
            elementData.type = $(this).data('type');
            elementData.value = $(this).data('value');
            properties.push(elementData);
        });
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=data.create',
            data: {
                title: $('#portfolio-title').val(),
                thumbnail: $('#portfolio-thumbnail').val(),
                category: categories.toString(),
                header: JSON.stringify(properties),
                url: $('#portfolio-url').val(),
                content: $('#portfolio-content_ifr').contents().find('#tinymce').html(),
                description: $('#portfolio-description_ifr').contents().find('#tinymce').html(),
                zt_cmd: 'ajax'
            }
        }, true);
    };
    
    w.portfolioSave = function (id) {
        var $categoriesEl = $('div#category-selector').find('input:checked');
        var categories = [];
        $categoriesEl.each(function () {
            categories.push($(this).val());
        });
        var $propertiesEl = $('div#property-selector').find('input:checked');
        var properties = [];
        $propertiesEl.each(function () {
            var elementData = {};
            elementData.name = $(this).data('name');
            elementData.type = $(this).data('type');
            elementData.value = $(this).data('value');
            properties.push(elementData);
        });
        zt.ajax.request({
            url: zt.settings.backendUrl + 'index.php?option=com_ztportfolio&task=data.save',
            data: {
                id: id,
                title: $('#portfolio-title').val(),
                thumbnail: $('#portfolio-thumbnail').val(),
                category: categories.toString(),
                header: JSON.stringify(properties),
                url: $('#portfolio-url').val(),
                content: $('#portfolio-content_ifr').contents().find('#tinymce').html(),
                description: $('#portfolio-description_ifr').contents().find('#tinymce').html(),
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

    w.publicCheckAll = function(parent){
        var $parent = $(parent).find('tbody');
        $parent.find('input[type="checkbox"]').prop('checked', $(parent).find('#check-all').prop('checked'));
    };

    
})(window, jQuery);