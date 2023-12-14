{
    var radio = document.getElementsByName("tipos");
    console.log(radio);

    [...radio].forEach(element => {
        element.onclick = function(){
            console.log(element.value);
            if (element.value == "Pago") {
                document.getElementsByName("precio_por_hora")[0].disabled = false;
            } else {
                document.getElementsByName("precio_por_hora")[0].value = "";
                document.getElementsByName("precio_por_hora")[0].disabled = true;
            }

        }
    });
}

