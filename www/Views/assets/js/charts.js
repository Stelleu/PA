function getRoleName(role) {
    switch (role) {
        case 0:
            return 'Admin';
        case 1:
            return 'Editor';
        case 2:
            return 'Moderator';
        case 3:
            return 'User';
        default:
            return 'Unknown Role';
    }
}


document.addEventListener("DOMContentLoaded", function () {
    console.log("ok")
    const ctx = document.getElementById('myChart').getContext('2d');
    const canvas = document.getElementById('myChart');
    const userInfoJSON = canvas.getAttribute('data-userInfo');
    const userInfo = JSON.parse(userInfoJSON); // Convertir la chaîne JSON en objet JavaScript

    // Maintenant vous pouvez utiliser l'objet userInfo dans votre script
    console.log(userInfo);
    const labels = userData.map(item => getRoleName(item.role));
    const data = userData.map(item => item.user_count);

    const usersChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    // Ajoutez plus de couleurs si nécessaire
                ],
            }],
        },
    });
});
