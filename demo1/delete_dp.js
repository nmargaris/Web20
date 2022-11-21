$("#delete").click(function() {
    if(confirm('Are you sure you want to delete everything?')){
        $.ajax({
            url: 'delete_db.php',
            method: 'POST',
            success: function (data){
               confirm(data);
            }
        })
    }

})
