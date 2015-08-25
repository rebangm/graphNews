$(document).ready(function() {
    $('#site_manage_select_limit').on('change',function(evnt){
        console.log('hello');
        location.href = $("option:selected",this).data('url');
    });
    $("#siteTable button").on('click',function(event){
        itemSetActive($(this));
    });
});


function itemSetActive(button){
    $.ajax({
        type: 'GET', // Le type de ma requete
        url: button.attr("data-url"), // L'url vers laquelle la requete sera envoyee
        success: function(data, textStatus, jqXHR) {
            console.log($("i",button));

            if (data.message.active == 1){
                button.addClass("btn-success").removeClass("btn-danger");
                $("i",button).addClass("glyphicon-ok").removeClass("glyphicon-remove");
            }
            else if(data.message.active == 0){
                button.addClass("btn-danger").removeClass("btn-success");
                $("i",button).addClass("glyphicon-remove").removeClass("glyphicon-ok");
            }
            button.attr("data-url", data.message.url);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(jqXHR);
        }
    });
}

$('#website-tab a').click(function (e) {
    console.log("test");
    e.preventDefault();
    $(this).tab('show');
})
