document.querySelectorAll(".modalTrigger").forEach((el) => {
    el.addEventListener("click", (e) => {
        const id = el.dataset.id;
        const subject = el.dataset.subject;

        const input = document.querySelector("#updateSubjectName");
        input.value = subject;

        document.querySelector(".modal-body form").action = "/subjects/" + id;
    });
});

document.querySelectorAll(".modalTriggerEditResult").forEach((el) => {
    el.addEventListener("click", (e) => {
        const id = el.dataset.id;

        document.querySelector("#updateResult").value = el.dataset.result;
        document.querySelector("#dateResult").value = el.dataset.date;
        document.querySelector("#subjectResult").value = el.dataset.subject;

        document.querySelector(".modal-body form").action = "/results/" + id;
    });
});

document.querySelector(".modalAddResult").addEventListener("click", (el) => {
    const studentId = document.querySelector(".modalAddResult").dataset.student;
    document.querySelector("#student_id_input").value = studentId;
});
