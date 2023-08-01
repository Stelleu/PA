<h2>Users</h2>
<div class="table-responsive small">
    <table class="table  table-sm">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" >Full Names</th>
            <th scope="col" >Email</th>
            <th scope="col" >Role</th>
            <th scope="col" >Since</th>
            <th scope="col" >Status</th>
            <th scope="col" >Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user) :

            $given_date = new DateTime($user->getDateInserted());
            // Obtenir la date actuelle
            $current_date = new DateTime();

            // Calculer la différence entre les deux dates
            $interval = $current_date->diff($given_date);

            // Extraire le nombre de semaines, mois et jours
            $weeks = floor($interval->days / 7);
            $months = $interval->y * 12 + $interval->m;
            $days = $interval->days;
            $hours = $interval->h;
            $minutes = $interval->i;

            // Construction de la phrase résultante
            $result = "";

            if ($weeks > 0) {
                $result .= "$weeks week" . ($weeks > 1 ? 's' : '') . " ";
            }
            if ($months > 0) {
                $result .= "$months mounth ";
            }
            if ($days > 0) {
                $result .= "$days day" . ($days > 1 ? 's' : '') . " ";
            }
            if ($hours > 0) {
                $result .= "$hours hour" . ($hours > 1 ? 's' : '') . " ";
            }
            if ($minutes > 0) {
                $result .= "$minutes min" . ($minutes > 1 ? 's' : '') . " ";
            } ?>
            <tr>
                <td><?= $user->getId() ?></td>
                <td>
                    <div class="row">
                        <p  class="text-secondary text-hover-primary mb-1"><?= $user->getFirstname()." ". $user->getLastname()?></p>
                    </div>
                </td>
                <td><?= $user->getEmail() ?></td>
                <td>
                    <?= match ($user->getRole()){
                        "1" => '<p class="text-info mb-1"> Editor </p>',
                        "2" => '<p class="text-secondary-emphasis mb-1">Moderator</p>',
                        "3" => '<p class="text-warning-emphasis  mb-1">Customer</p>',
                        default => '<p class="text-primary mb-1">Admin</p>'
                    }
                    ?>
                </td>
                <td><?= $result."ago" ?></td>
                <td><p class="badge text-center rounded-pill <?= ($user->getStatus()==1)?" text-bg-success" : "text-bg-danger"?> px-4"><?= $user->getStatus() ?></p></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" data-user-id="<?= $user->getId() ?>" data-action="edit">Edit</a>
                            <a class="dropdown-item" href="#" data-user-id="<?= $user->getId() ?>" data-action="delete">Delete</a>
                            <!-- Ajoutez d'autres liens d'action avec les attributs data-* pour les informations spécifiques à chaque utilisateur -->
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

