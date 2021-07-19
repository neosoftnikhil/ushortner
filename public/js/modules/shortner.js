/**
 * Created by Nikhil Jain on 18-01-2017.
 */

app.shortner = {

    events: {
        switch: function () {
            $(document).on('click', ".change_status", function () {
                var status = '1';
                if ($(this).closest("div.switch-button").children("input:checked").length > '0') {
                    status = '0';
                }

                var id = $(this).closest("div.switch-button").children("input").attr('rel');
                var spath = $(this).closest("div.switch-button").children("input").attr('formaction');
                var url = app.config.SITE_PATH + spath +'/change_status';
                app.changeStatus(id, url, status);
            });
        },

        delete: function () {
            $(document).on('click', ".deleteRecord", function () {
                var dpath = $(this).attr('formaction');
                var result = confirm("Are you sure you want to delete this "+dpath.toUpperCase()+"?");
                if (result) {
                    var id = $(this).attr('rel');
                    var url = app.config.SITE_PATH + dpath +'/delete';
                    app.deleteRecord(id, url);
                }
            });
        },

        init: function () {
            app.shortner.events.switch();
            app.shortner.events.delete();
            app.dataTable.search();
            app.dataTable.reset();

        },

    },

    action: {
        event:{
            common:function () {},
            custome_validations:function () {}
        },
        addOrUpdate: function(url) {
            $("#app_form").on('submit',function(e) {
                e.stopPropagation();
                if (!$(this).valid()) {
                    return false;
                }
                var formData = new FormData(this);
                $.ajax({
                    cache: false,
                    url: baseUrl + url,
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,                            
                    success: function (response) {
                        console.log(response);
                        if (response.status_code == 1) {
                            window.location.href = response.url;
                        } else {
                            $(".ajax_error_msg").html(response.error_message_html);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
    
            });
        }
    },

    init: function () {
        app.shortner.events.init();
        app.dataTable.custom({"url":'shortner/datatable'});
        app.dataTable.eventFire();
    }
}