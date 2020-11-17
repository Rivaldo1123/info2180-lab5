window.onload = function() {
    var request = new XMLHttpRequest();
    const lookup = document.getElementById('lookup');
    const lookupC = document.getElementById('lookupC');

    lookupC.addEventListener('click', function(e) {
        e.preventDefault();
        var query2 = document.getElementById('country').value;
        request.onreadystatechange = function() {
            if (request.readyState == XMLHttpRequest.DONE && request.status == 200) {
                var data = request.response;
                var result = document.getElementById('result');
                result.innerHTML = data;
            }
        }
        request.open("GET", 'world.php?country=' + query2 + '&context=cities', true);
        request.send();
    });

    lookup.addEventListener('click', function(e) {
        e.preventDefault();
        var query = document.getElementById('country').value;
        request.onreadystatechange = function() {
            if (request.readyState == XMLHttpRequest.DONE && request.status == 200) {
                var data = request.response;
                var result = document.getElementById('result');
                result.innerHTML = data;
            }
        }
        request.open("GET", 'world.php?country=' + query, true);
        request.send();
    })




}