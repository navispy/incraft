<?php
?>

<div class="send-message-dialog">
    <div class="caption-wrapper">
        <div class="caption">
            <span>Напишите сообщение продавцу</span>
        </div>
        <div class="cancel">
            <svg fill="black" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                <path d="M0 0h24v24H0z" fill="none" />
            </svg>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="content-subwrapper">
            <div class="input input-1">
                <span>Ваше имя</span>
                <input class="detail name" data-field="User" />
            </div>
            <div class="input input-2">
                <span>Ваш email</span>
                <input class="detail email" data-field="Email" />
            </div>
            <div class="input input-3">
                <span>Ваш телефон</span>
                <input class="detail phone" data-field="Phone" />
            </div>
            <div class="textarea textarea-1">
                <span>Ваш комментарий</span>
                <textarea cols="40" row="20" class="detail comment"></textarea>
            </div>

            <div class="send">
                <span>Отправить</span>
            </div>
        </div>
    </div>
</div>