var transfer = function() {



    var inSource    = $('.tranfer-account.in.source').clone().removeClass('source');
    $('.tranfer-account.in.source').remove();

    $('.account-in-wrapper a[role=add-account]').click(function(e) {
        console.log('in');
        e.preventDefault();
        var newItem = inSource.clone();

        // find max new id
        var newId = null;
        do {
            newId = Math.random().toString(36).substr(2, 5);
        } while ($('#transfer_account_new_' + newId).length > 0);

        newItem.html(newItem.html().split('newtransferaccount').join('new_' + newId));
        newItem.attr('id', 'transfer_account_new_' + newId);

        $('.account-in-wrapper').append(newItem);
        return false;
    });

    var outSource   = $('.tranfer-account.out.source').clone().removeClass('source');
    $('.tranfer-account.out.source').remove();

    $('.account-out-wrapper a[role=add-account]').click(function(e) {
        console.log('out');
        e.preventDefault();
        var newItem = outSource.clone();

        // find max new id
        var newId = null;
        do {
            newId = Math.random().toString(36).substr(2, 5);
        } while ($('#transfer_account_new_' + newId).length > 0);

        newItem.html(newItem.html().split('newtransferaccount').join('new_' + newId));
        newItem.attr('id', 'transfer_account_new_' + newId);

        $('.account-out-wrapper').append(newItem);
        return false;
    });



}();
