'use strict'
const openModalClassList = document.querySelectorAll('.modal-open')
const closeModalClassList = document.querySelectorAll('.modal-close')
const overlay = document.querySelector('.modal-overlay')
const body = document.querySelector('body')
const modal = document.querySelector('.modal')
const modalInnerHTML = document.getElementById('modalInner')
let csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
let user_id = document.head.querySelector('meta[name="user_id"]').content;
var scrollPosition;

for (let i = 0; i < openModalClassList.length; i++) {
    openModalClassList[i].addEventListener('click', (e) => {
        // form要素に送信先が指定されていない場合、現在のURLに対してフォームの内容を送信するのを阻止。
        e.preventDefault()
        let eventId = parseInt(e.currentTarget.id.replace('event-', ''))
        openModal(eventId)
        console.log(eventId);
    }, false)
}

for (var i = 0; i < closeModalClassList.length; i++) {
    closeModalClassList[i].addEventListener('click', closeModal)
}

overlay.addEventListener('click', closeModal)

async function openModal(eventId) {
    await $.ajax({
        url: `/get_event/${eventId}`,
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: event => {

            var status_color = "";
            var status_name = "";
            switch (Number(event.status)) {
                case 0:
                    status_color = "yellow";
                    status_name = '未提出';
                    break;
                case 1:
                    status_color = "green";
                    status_name = '参加';
                    break;
                case 2:
                    status_color = "gray";
                    status_name = '不参加';
                    break;
                case 3:
                    status_color = "green";
                    status_name = '提出済み';
                    break;

                default:
                    break;
            }
            var date = document.getElementById(`event-${eventId}-date`).textContent;
            var time = document.getElementById(`event-${eventId}-time`).textContent;
            let current_time = event.current_time;
            let event_deadline = event.deadline;
            let event_detail = event.detail;
            if (event_detail) {
                event_detail = event.detail.replace(/\r?\n/g, '<br>');
            }else{
                event_detail = "詳細はありません。";
            }
            let modalHTML = `
                    <h2 class="text-md font-bold mb-3">${event.name}</h2>
                    <p class="text-sm">${date}</p>
                    <p class="text-sm">${time}</p>

                    <hr class="my-4">

                    <p class="text-md">
                        【詳細】<br>
                        ${event_detail}
                    </p>
                    <hr class="my-4">
                    <p class="text-sm"><span class="text-xl">${event.participants}</span>人参加 ></p>
                    `

            modalHTML += `
                    <div class="text-center mt-6">
                        <p class="text-lg font-bold text-${status_color}-400">${status_name}</p>
                        <p class="text-xs text-${status_color}-400">期限 ${event.deadline}</p>
                    </div>`

            if (current_time <= event_deadline) {
                modalHTML += `
                        <form action="/send" method="post">
                        <div class="flex mt-5 ">
                        `

                let modal_button = "";
                switch (Number(event.questionnaire_id)) {
                    case 1:
                        modal_button = ` 
                                <button type='submit' name="status_id" value="1" class="participation flex-1 py-2 mx-3 rounded-3xl text-lg font-bold" id="modal__participation">参加する</button>
                                <button type='submit' name="status_id" value="2" class="non__participation flex-1 py-2 mx-3 rounded-3xl text-lg font-bold" id="modal__nonParticipation">参加しない</button>`
                        break;
                    case 2:
                        modal_button = ` 
                                <button type='submit' name="status_id" value="3" class="submission__button flex-1 py-2 mx-3 rounded-3xl text-lg font-bold" id="submission__button">提出</button>`
                        break;
                    default:
                        break;
                }
                modalHTML += `
                            ${modal_button}
                            <input type="hidden" name="user_id" value="${user_id}">
                            <input type="hidden" name="event_id" value="${eventId}">
                            <input type = "hidden" name = "_token" value ="${csrf_token}">
                            </div>
                            <div class="mb-3 mt-6">
                            <label for="exampleFormControlTextarea1" class="form-label">備考欄(あれば)</label>
                            <textarea class="w-full p-4 text-sm mb-3 form-control border" id="exampleFormControlTextarea1" name="comment" rows="3"></textarea>
                            </div>
                    </form>`
            } else {
                modalHTML += `
                            
                                <p class="input__deadline__text flex-1 py-2 mx-3 rounded-3xl text-lg font-bold text-center">入力締め切りました！</p>
                            </div>
                            </form>`
            }
            modalInnerHTML.insertAdjacentHTML('afterbegin', modalHTML)

            switch (Number(event.questionnaire_id)) {
                case 1:
                    // status_idとイベントの提出期限によって、参加・不参加ボタンを活性、非活性にする
                    let participation_button = document.getElementById("modal__participation");
                    let nonParticipation_button = document.getElementById("modal__nonParticipation");

                    if (event.status == 1 && current_time <= event_deadline) {
                        participation_button.classList.add("cantClick");
                        nonParticipation_button.classList.remove("cantClick");
                        participation_button.classList.add("selected");
                        nonParticipation_button.classList.add("non__selected");
                        participation_button.disabled = true;
                        nonParticipation_button.disabled = false;
                    } else if (event.status == 2 && current_time <= event_deadline) {
                        participation_button.classList.remove("cantClick");
                        nonParticipation_button.classList.add("cantClick");
                        participation_button.classList.add("non__selected");
                        nonParticipation_button.classList.add("selected");
                        nonParticipation_button.disabled = true;
                        participation_button.disabled = false;
                    } else if (event.status == 0 && current_time <= event_deadline) {
                        participation_button.classList.add("non__selected");
                        nonParticipation_button.classList.add("non__selected");
                    } else {
                        console.log("締切過ぎてるよ!");
                    }
                    break;

                case 2:
                    let submission__button = document.getElementById("submission__button");
                    if (event.status == 3 && current_time <= event_deadline) {
                        submission__button.classList.add("cantClick");
                        submission__button.classList.add("selected");
                        submission__button.classList.remove("submission__button");
                        submission__button.innerText = "提出済み";
                        submission__button.disabled = true;
                    } else {
                        console.log("締切過ぎてるよ!");
                    }

                    break;
            }
            scrollPosition = $(window).scrollTop();
            $('body').css('position', 'fixed');
            $('body').css('top', '-' + scrollPosition + 'px');
        },
        error: () => {
            console('error');
        }
    })
    toggleModal()
}



function closeModal() {
    modalInnerHTML.innerHTML = ''
    $('body').css('position', '');
    $('body').css('top', '');
    $(window).scrollTop(scrollPosition);
    toggleModal()
}

function toggleModal() {
    modal.classList.toggle('opacity-0')
    modal.classList.toggle('pointer-events-none')
    body.classList.toggle('modal-active')
}

async function participateEvent(eventId) {
    try {
        let formData = new FormData();
        formData.append('eventId', eventId);
        const url = '/api/postEventAttendance.php'
        await fetch(url, {
            method: 'POST',
            body: formData
        }).then((res) => {
            if (res.status !== 200) {
                throw new Error("system error");
            }
            return res.text();
        })
        closeModal()
        location.reload()
    } catch (error) {
        console.log(error)
    }
}

/*------------------------------
* アコーディオン
-------------------------------*/
$(function () {
    $('.js-menu__item__link').each(function () {
        $(this).on('click', function () {
            $("+.submenu", this).slideToggle();
            return false;
        });
    });
});