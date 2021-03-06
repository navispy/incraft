<?php
?>

<div class="page-1-shop-edit-wrapper">
    <div class="text">
        <div class="name-wrapper">
            <div class="name">
                <input class="input input-shop-name" data-field="Name">
                <div class="icon-edit name-edit-btn" data-control="input-shop-name">
                    <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.4 12.2999L12.8 1.8999L15.6 4.6999L5.2 15.0999L1.5 16.0999L2.4 12.2999Z" fill="white" />
                        <path d="M12.8 3.3L14.2 4.7L4.69995 14.2L2.89995 14.7L3.29995 12.8L12.8 3.3ZM12.8 0.5L1.49995 11.8L0.199951 17.6L5.69995 16L17 4.7L12.8 0.5Z" fill="black" />
                        <path d="M10 4L13.5 7.5" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                        <path d="M2.19995 11.7998L5.69995 15.2998" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                        <path d="M1.5 12.5V16.5L5.5 15.5L1.5 12.5Z" fill="black" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="address-wrapper">
            <div class="address">
                <svg width="12" height="15" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.1 5.6C11.1 8.4 6 14 6 14C6 14 1 8.4 1 5.6C1 2.8 3.3 0.5 6.1 0.5C8.9 0.5 11.1 2.8 11.1 5.6Z" stroke="black" stroke-miterlimit="10" />
                </svg>

                <input class="input input-shop-address" readonly data-field="Address"></input>

                <div class="icon-edit address-edit-btn" data-control="input-shop-address">
                    <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.4 12.2999L12.8 1.8999L15.6 4.6999L5.2 15.0999L1.5 16.0999L2.4 12.2999Z" fill="white" />
                        <path d="M12.8 3.3L14.2 4.7L4.69995 14.2L2.89995 14.7L3.29995 12.8L12.8 3.3ZM12.8 0.5L1.49995 11.8L0.199951 17.6L5.69995 16L17 4.7L12.8 0.5Z" fill="black" />
                        <path d="M10 4L13.5 7.5" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                        <path d="M2.19995 11.7998L5.69995 15.2998" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                        <path d="M1.5 12.5V16.5L5.5 15.5L1.5 12.5Z" fill="black" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="phone-wrapper">
            <div class="phone">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.2 1.09961L9.39998 3.89961L11.5 5.99961L6.49998 10.9996L4.39998 8.89961L1.59998 11.6996L3.89998 13.9996C4.99998 15.0996 6.69998 15.0996 7.69998 13.9996L14.5 7.19961C15.6 6.09961 15.6 4.39961 14.5 3.39961L12.2 1.09961Z" stroke="#333333" stroke-miterlimit="10" />
                </svg>

                <div>
                    <span>??????:</span>
                    <input class="input input-shop-phone" readonly data-field="Phone"></input>
                </div>

                <div class="icon-edit phone-edit-btn" data-control="input-shop-phone">
                    <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.4 12.2999L12.8 1.8999L15.6 4.6999L5.2 15.0999L1.5 16.0999L2.4 12.2999Z" fill="white" />
                        <path d="M12.8 3.3L14.2 4.7L4.69995 14.2L2.89995 14.7L3.29995 12.8L12.8 3.3ZM12.8 0.5L1.49995 11.8L0.199951 17.6L5.69995 16L17 4.7L12.8 0.5Z" fill="black" />
                        <path d="M10 4L13.5 7.5" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                        <path d="M2.19995 11.7998L5.69995 15.2998" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                        <path d="M1.5 12.5V16.5L5.5 15.5L1.5 12.5Z" fill="black" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="photo-wrapper">
        <input class="new-photo" type="file" accept="image/*" data-field="Photo" />
        <img class="photo-content" src="img/no-image-icon.png">
        <div class="button-edit-photo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.4 15.2999L16.8 4.8999L19.6 7.6999L9.2 18.0999L5.5 19.0999L6.4 15.2999Z" fill="white"></path>
                <path d="M16.8 6.3L18.2 7.7L8.69995 17.2L6.89995 17.7L7.29995 15.8L16.8 6.3ZM16.8 3.5L5.49995 14.8L4.19995 20.6L9.69995 19L21 7.7L16.8 3.5Z" fill="black"></path>
                <path d="M14 7L17.5 10.5" stroke="black" stroke-width="2" stroke-miterlimit="10"></path>
                <path d="M6.19995 14.7998L9.69995 18.2998" stroke="black" stroke-width="2" stroke-miterlimit="10"></path>
                <path d="M5.5 15.5V19.5L9.5 18.5L5.5 15.5Z" fill="black"></path>
            </svg>
        </div>
    </div>
</div>

<div class="page-1-goods-edit-wrapper">
    <div class="goods-edit-commands">
        <div class="goods-edit-select-all">
            <label class="container">
                <input class="rcv-msg rcv-msg-from-visitors" type="checkbox" data-field="ReceiveMsgFromVisitors">
                <span class="checkmark fixed"></span>
            </label>
        </div>
        <div class="goods-edit-cmd">
            <svg width="21" height="7" viewBox="0 0 21 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 0C20 2 15.7467 6 10.5 6C5.25329 6 1 2 1 0" stroke="#929292" />
            </svg>
            <span>????????????</span>
        </div>
        <div class="goods-edit-cmd">
            <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 5H5V18H15V5Z" stroke="#929292" stroke-miterlimit="10" />
                <path d="M11 1H1V14H11V1Z" stroke="#929292" stroke-miterlimit="10" />
            </svg>
            <span>????????????????????</span>
        </div>
        <div class="goods-edit-cmd">
            <svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.9001 15.5004H2.1001L1.1001 2.90039H10.9001L9.9001 15.5004Z" stroke="#929292" stroke-miterlimit="10" />
                <path d="M4 2.9C4 1.9 4.8 1 5.9 1C7 1 7.8 1.8 7.8 2.9" stroke="#929292" stroke-miterlimit="10" />
                <path d="M7.5 6V13" stroke="#929292" stroke-miterlimit="10" />
            </svg>
            <span>??????????????</span>
        </div>

    </div>
    <div class="goods-edit-command-add">
        <span>???????????????? ??????????</span>
    </div>
</div>

<div class="page-1-goods-list-wrapper">

</div>