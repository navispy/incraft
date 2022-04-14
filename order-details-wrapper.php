<?php
?>

<div class="order-details-dialog">
    <div class="caption-wrapper">
        <div class="caption">
            <span>Размещение заказа</span>
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
                <span>Имя пользователя</span>
                <input class="detail name" data-field="User"/>
            </div>
            <div class="input input-2">
                <span>Email</span>
                <input class="detail email" data-field="Email" />
            </div>
            <div class="input input-3">
                <span>Телефон</span>
                <input class="detail phone" data-field="Phone" />
            </div>
            <div class="input input-4">
                <span>Адрес</span>
                <input class="detail address" data-field="Address" />
            </div>

            <div class="payment-wrapper">
                <div class="caption">
                    <span>Оплата</span>
                </div>
                <div class="methods">
                    <?php include 'payment-methods-order-details.php'; ?>
                </div>
            </div>

            <div class="delivery">
                <div class="caption">
                    <span>Доставка</span>
                </div>
                <div class="options">
                    <?php include 'delivery-options-order-details.php'; ?>
                </div>
            </div>

            <div class="place">
                <span>Разместить</span>
            </div>
        </div>
    </div>
</div>