document.addEventListener("DOMContentLoaded", function(){
    document.getElementById('lookup').addEventListener('click', function(){
        
        const disRes = document.getElementById('result');
        const userfld = document.getElementById('country').value.trim();

        fetch("world.php?country=" + encodeURIComponent(userfld))
        .then(res => res.text())
        .then(data => {
            disRes.innerHTML = data;
        })
        .catch(error => {
                console.error(error);
            });
    });

    //City Button 
    document.getElementById('cities').addEventListener('click', function(){
            
            const disRes = document.getElementById('result');
            const userfld = document.getElementById('country').value.trim();

            fetch("world.php?country=" + encodeURIComponent(userfld) + "&lookup=cities")
            .then(res => res.text())
            .then(data => {
                disRes.innerHTML = data;
            })
            .catch(error => {
                    console.error(error);
                });
        });
});
