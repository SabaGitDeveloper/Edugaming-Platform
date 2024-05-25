<?php
use yii\helpers\Html;
?>

<div id="bdSidebar" class="d-flex flex-column flex-shrink-0 p-3 bg-success text-white offcanvas-md offcanvas-start">
    <a href="#" class="navbar-brand"></a>
    <hr>
    <ul class="mynav nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-1" style="display: flex; align-items: center;">
            <i class="fa-regular fa-user" style="margin-right: 9px; margin-left: 8px;"></i>
            <?= Html::a('Progress', ['student/progress'], ['style' => 'text-decoration: none;']) ?>
        </li>
        <li class="nav-item mb-1" style="display: flex; align-items: center;">
            <i class="fa-regular fa-bookmark" style="margin-right: 11px; margin-left: 8px;"></i>
            <?= Html::a('Assignments', ['student/assgall'], ['style' => 'text-decoration: none;']) ?>
        </li>
        <li class="nav-item mb-1" style="display: flex; align-items: center;">
            <i class="fa-regular fa-newspaper" style="margin-right: 7px; margin-left: 8px;"></i>
            <?= Html::a('Requests', ['student/request'], ['style' => 'text-decoration: none;']) ?>
        </li>
        <li class="nav-item mb-1" style="display: flex; align-items: center;">
            <i class="fa-solid fa-archway" style="margin-right: 7px; margin-left: 8px;"></i>
            <?= Html::a('Courses', ['student/courses'], ['style' => 'text-decoration: none;']) ?>
        </li>
        <li class="sidebar-item  nav-item mb-1">
            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#settings" aria-expanded="false" aria-controls="settings">
                <i class="fas fa-cog pe-2"></i>
                <span class="topic">Settings </span>
            </a>
            <ul id="settings" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
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
                EduGames Platform
            </h6>
        </span>
    </div>
</div>
