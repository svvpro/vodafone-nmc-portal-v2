app.filter('phoneFiler', function(){
    return function(str){
        var phone = "(0" + str.toString().slice(0,2) + ") " + str.toString().slice(2,5) + "-" + str.toString().slice(5,7) + "-" + str.toString().slice(7,9);
        return phone;
    }
});

app.filter('toString', function(){
    return function(str){
        var number = str.toString();
        return number;
    }
});

app.filter('toUnixTime', function(){
    return function(str){
        var unix =  moment(str).unix();
        return unix;
    }
});