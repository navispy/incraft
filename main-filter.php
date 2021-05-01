<?php
?>
<div class="main-filter">
    <div class="block price">
        <p>Цена, BYN</p>
        <div class="range">
            <input id="from" type="number" placeholder="От" />
            <input id="to" type="number" placeholder="До" />
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
        <select class="cb-ысщзу">
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

    <div class="block instock">
        <p>Наличие</p>
        <select class="cb-ысщзу">
            <option disabled="" selected="">В наличии и под заказ</option>
        </select>
    </div>

    <div class="block search">
        <span>Найдено 18 предложений</span>
    </div>

</div>