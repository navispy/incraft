<?php
?>

<div class="good-edit-dialog">
    <div class="caption-wrapper">
        <div class="caption">
            <span>Добавление товара</span>
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
            <div class="content">
                <div class="input input-1">
                    <span>Наименование</span>
                    <input class="input-class name" />
                </div>
                <div class="input input-2">
                    <span>Материал</span>
                    <select class="cb-material">
                    </select>
                </div>
                <div class="input input-3">
                    <span>Цена</span>
                    <input class="input-class price" type="number">
                </div>
            </div>
            <div class="content">
                <div class="input input-4">
                    <span>Описание</span>
                    <textarea class="input-class description"></textarea>
                </div>

                <label class="checkmark-container">
                    <input class="is-available" type="checkbox" data-field="IsAvailable">
                    <span class="checkmark-new"></span>
                    <span>В наличии</span>
                </label>
            </div>
        </div>
        <div class="photo-subwrapper">

            <div class="caption">
                <span>Фотографии</span>
            </div>

            <div class="add-photo">

                <div class="upload-photo">
                    <input class="good-photo" type="file" multiple accept="image/*" />
                    <div class="progress-bar-wrapper">
                        <progress class="progress-bar" max=100 value=0>
                        </progress>
                    </div>

                    <div class="upload-photo-text">
                        <span class="upload-photo-comment">Перетащите фото сюда или нажмите на + чтобы открыть окно</span>
                    </div>
                    <div class="upload-photo-button">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="16.5" y1="2.18557e-08" x2="16.5" y2="32" stroke="#0079C4" />
                            <line x1="32" y1="16.5" x2="-4.37114e-08" y2="16.5" stroke="#0079C4" />
                        </svg>
                    </div>
                </div>
                <div class="stack-photo-wrapper">
                    <div class="stack-photo">
                    </div>
                </div>
            </div>

        </div>

        <div class="save">
            <span>Сохранить</span>
        </div>
    </div>
</div>