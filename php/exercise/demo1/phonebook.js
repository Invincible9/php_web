$(function () {

    $('#btnLoad').click(loadData);

    const baseURL = "https://phonebook-live-2dc6c.firebaseio.com/phonebook/";

    function loadData() {
        $('#phonebook').empty();
        $.get("https://phonebook-live-2dc6c.firebaseio.com/.json",
            function (data) {

                data = data['phonebook'];
                let keys = Object.keys(data);

                for (let key of keys) {
                    let name = data[key]['person'];
                    let phone = data[key]['phone'];

                    $('#phonebook')
                            .append($('<li>')
                            .text(name + ": " + phone)
                            .append(`<a href="#">[DELETE]</a>`)
                            .click(function () {
                        $.ajax({
                            method: "DELETE",
                            url: `${baseURL}${key}.json`,
                        }).then(loadData)
                            .catch(error);
                    }));
                }
            });
    }

    $('#btnCreate').on('click', function () {
        let name = $('#person').val();
        let phone = $('#phone').val();

        let person = {
            person: name,
            phone: phone
        };

        $.ajax({
            method: "POST",
            url: "https://phonebook-live-2dc6c.firebaseio.com/phonebook/.json",
            contentType: "application/json",
            data: JSON.stringify(person)
        }).then(loadData)
            .catch(error);

    });

    function error(err) {
        console.log(err.message)
    }
});