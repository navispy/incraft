<?php
?>
<div class="main-filter">
    <div class="block price">
        <p>Цена, BYN</p>
        <div class="range">
            <input class="from" type="number" placeholder="От" />
            <input class="to" type="number" placeholder="До" />
        </div>
        <div class="slider"></div>
    </div>
    <div class="block material">
        <p>Поиск изделий по материалу</p>
        <select class="cb-material">
            <option disabled="" selected="">Любые (всего 16)</option>
        </select>
    </div>
    <div class="block scope">
        <p>Сфера деятельности</p>
        <select class="cb-scope">
            <option disabled="" selected="">Любая (всего 14)</option>
        </select>
    </div>
    <div class="block location">
        <p>Где ищем?</p>
        <select class="cb-region">
            <option disabled="" selected="">Область</option>
        </select>
        <select class="cb-district">
            <option disabled="" selected="">Район</option>
        </select>
        <div class="chk-bychow">
            <input class="checkbox" type="checkbox" name="chk-00" id="chk-00">
            <label for="chk-00">Только Быхов</label>
        </div>
    </div>

    <div class="block availability">
        <p>Наличие</p>
        <select class="cb-availability">
            <option value="1">В наличии и под заказ</option>
            <option value="2">В наличии</option>
            <option value="3">Под заказ</option>
        </select>
    </div>

    <div class="block search">
        <span>Найдено 18 предложений</span>
    </div>

</div>