<?php
?>

<div class="options">
    <label class="container-radio PaymentMethod_01">
        <input type="radio" name="payment-methods" data-field="PaymentMethod" value="PaymentMethod_01" />
        <span class="checkmark-radio"></span>    
        <span>Наличные</span>
    </label>
    <label class="container-radio PaymentMethod_02">
        <input type="radio" name="payment-methods" data-field="PaymentMethod" value="PaymentMethod_02" />
        <span class="checkmark-radio"></span>    
        <span>По банковской карте (только бесконтактные платежи)</span>
    </label>
    <label class="container-radio PaymentMethod_03">
        <input type="radio" name="payment-methods" data-field="PaymentMethod" value="PaymentMethod_03" />
        <span class="checkmark-radio"></span>
        <span>По банковской карте (все платежи)</span>
    </label>
    <label class="container-radio PaymentMethod_04">
        <input type="radio" name="payment-methods" data-field="PaymentMethod" value="PaymentMethod_04" />
        <span class="checkmark-radio"></span>
        <span>По картам рассрочки</span>
    </label>

    <div class="options-credit-cards PaymentMethod_04">
        <?php include 'credit-card-options-order-details.php'; ?>
    </div>

    <label class="container-radio PaymentMethod_05">
        <input type="radio" name="payment-methods" data-field="PaymentMethod" value="PaymentMethod_05" />
        <span class="checkmark-radio"></span>
        <span>Через ЕРИП</span>
    </label>
    <label class="container-radio PaymentMethod_06">
        <input type="radio" name="payment-methods" data-field="PaymentMethod" value="PaymentMethod_06" />
        <span class="checkmark-radio"></span>
        <span>Наложенный платеж</span>
    </label>
    <label class="container-radio PaymentMethod_07">
        <input type="radio" name="payment-methods" data-field="PaymentMethod" value="PaymentMethod_07" />
        <span class="checkmark-radio"></span>
        <span>Прочее</span>
    </label>
</div>