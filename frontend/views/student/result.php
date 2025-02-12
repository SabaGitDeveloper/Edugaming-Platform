<?php 
use yii\helpers\Html;
/** @var yii\web\View  $this  */
$this->title = 'Assignment Details';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,
                   initial-scale=1.0">
    <title>Bootstrap5 Sidebar</title>
    <link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
          rel="stylesheet"
        integrity=
"sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
          crossorigin="anonymous">
    <link rel="stylesheet" 
          href="style.css">
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity=
"sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" 
        referrerpolicy="no-referrer" />
</head>
<style>
  html, body {
    height: 100%;
    font-family: 'Ubuntu', sans-serif;
}

.gfg {
    height: 50px;
    width: 50px;

}

.mynav {
    color: #fff;
}

.mynav li a {
    color: #fff;
    text-decoration: none;
    width: 100%;
    display: block;
    border-radius: 5px;
    padding: 8px 5px;
}

.mynav li a.active {
    background: rgba(255, 255, 255, 0.2);
}

.mynav li a:hover {
    background: rgba(255, 255, 255, 0.2);
}

.mynav li a i {
    width: 25px;
    text-align: center;
}

.notification-badge {
    background-color: rgba(255, 255, 255, 0.7);
    float: right;
    color: #222;
    font-size: 14px;
    padding: 0px 8px;
    border-radius: 2px;
}
</style>
<body>
    <div class="container-fluid p-0 d-flex h-100">
        <div id="bdSidebar" 
             class="d-flex flex-column 
                    flex-shrink-0 
                    p-3 bg-success
                    text-white offcanvas-md offcanvas-start">
            <a href="#" 
               class="navbar-brand">
            </a><hr>
            <ul class="mynav nav nav-pills flex-column mb-auto">
            <li class="nav-item mb-1" style="display: flex; align-items: center;">
                        <i class="fa-regular fa-user" style="margin-right: 9px; margin-left: 8px;"></i>
                        <?= Html::a('Progress', ['/student/progress'], ['style' => 'text-decoration: none;']) ?>
                </li>

                <li class="nav-item mb-1" style="display: flex; align-items: center;">
                        <i class="fa-regular fa-bookmark" style="margin-right: 11px; margin-left: 8px;"></i>
                        <?= Html::a('Assignments', ['/student/assgall'], ['style' => 'text-decoration: none;']) ?>
                </li>
                <li class="nav-item mb-1" style="display: flex; align-items: center;">
                        <i class="fa-regular fa-newspaper" style="margin-right: 7px; margin-left: 8px;"></i>
                        <?= Html::a('Requests', ['/student/request'], ['style' => 'text-decoration: none;']) ?>
                </li>
                <li class="nav-item mb-1" style="display: flex; align-items: center;">
                       <i class="fa-solid fa-archway" style="margin-right: 7px; margin-left: 8px;"></i>
                       <?= Html::a('Courses', ['/student/courses'], ['style' => 'text-decoration: none;']) ?>
                </li>
                <li class="sidebar-item  nav-item mb-1">
                    <a href="#" 
                       class="sidebar-link collapsed" 
                       data-bs-toggle="collapse"
                       data-bs-target="#settings"
                       aria-expanded="false"
                       aria-controls="settings">
                        <i class="fas fa-cog pe-2"></i>
                        <span class="topic">Settings </span>
                    </a>
                    <ul id="settings" 
                        class="sidebar-dropdown list-unstyled collapse" 
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-user-plus pe-2"></i>
                                <span class="topic">Switch Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-sign-out-alt pe-2"></i>
                                <span class="topic">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <hr>
            <div class="d-flex">
                <i class="fa-solid fa-book  me-2"></i>
                <span>
                    <h6 class="mt-1 mb-0">
                        EduGames Learning Platform
                    </h6>
                </span>
            </div>
        </div>
        <div class="bg-light flex-fill">
            <div class="p-2 d-md-none d-flex text-white bg-success">
                <a href="#" class="text-white" 
                   data-bs-toggle="offcanvas"
                   data-bs-target="#bdSidebar">
                    <i class="fa-solid fa-bars"></i>
                </a>
                <span class="ms-3">EduGames Learning Portal</span>
            </div>
            <div class="p-4">
            <h1><?= Html::encode($this->title) ?></h1>
                <hr>
    <table class="table table-hover">
    <thead>
    <tr>
        <th scope="col"><span>Accuracy</span></th>
        <th scope="col"><span>Speed</span></th>
        <th scope="col"><span>Tries</span></th>
        <th scope="col"><span>Badge</span></th>
        <th scope="col"><span>Actions</span></th>
    </tr>
    </thead>
    <tbody>
                <tr>
                    <th scope="row"><span><?= $accuracy ?></span></th>
                    <td><span><?= $speed ?></span></td>
                    <td><span><?= $tries ?></span></span></td>
                    <td><?php 
                    if($accuracy>90){?>
                    <span><h3>⭐</h3></span>
                    <?php }
                    else{
                    ?><span>----</span></td><?php } if (($mode=="quiz" && $tries==0) || $mode=="learning") { if ($assignmentid!==null) {?>
                    <td><span><?= Html::a("Play", ['formbasedgame', 'qid' => $questionset,'inid' => $interface,'assignmentid'=>$assignmentid], ['style' => 'text-decoration: none;']) ?></span></td>
                    <?php } else {
                        ?><td><span><?= Html::a("Play", ['formbasedgame', 'qid' => $questionset,'inid' => $interface,'assignmentid'=>$aid], ['style' => 'text-decoration: none;']) ?></span></td><?php } }?>
                </tr>
    </tbody>
    </table>
    <span style="float: right"><?= Html::a('Back to Assignments', ['assignment','id' => $topicid,'courseid' => $courseid], ['style' => 'text-decoration: none;']) ?></span>
</div>
</div>
</body>
</html>