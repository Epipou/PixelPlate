/*Système de réservation des tables */
document.addEventListener('DOMContentLoaded', function () {
    const seats = document.querySelectorAll('.seat');
    const counterElement = document.getElementById('counter');
    const hiddenInput = document.getElementById('selected-seats');
    const submitBtn = document.getElementById('next-step');

    let totalToSelect = parseInt(counterElement?.textContent ?? 0);
    let selectedSeats = [];
    let currentTable = null;

    seats.forEach(seat => {
        if (seat.classList.contains('disabled')) return;

        seat.addEventListener('click', function () {
            const seatData = {
                table: this.dataset.table,
                seat: this.dataset.seat
            };

            const index = selectedSeats.findIndex(s =>
                s.table === seatData.table && s.seat === seatData.seat
            );

            if (index !== -1) {
                selectedSeats.splice(index, 1);
                this.classList.remove('selected');

                if (selectedSeats.length === 0) {
                    currentTable = null;
                }
            } else if (selectedSeats.length < totalToSelect) {
                if (!currentTable || currentTable === seatData.table) {
                    currentTable = seatData.table;
                    selectedSeats.push(seatData);
                    this.classList.add('selected');
                } else {
                    const currentCount = selectedSeats.filter(s => s.table === currentTable).length;

                    if (currentCount === document.querySelectorAll(`.seat[data-table="${currentTable}"]:not(.disabled)`).length) {
                        currentTable = seatData.table;
                        selectedSeats.push(seatData);
                        this.classList.add('selected');
                    } else {
                        alert("Veuillez compléter la table actuelle avant d'en choisir une autre.");
                    }
                }
            }

            const remaining = totalToSelect - selectedSeats.length;
            counterElement.textContent = remaining;
            hiddenInput.value = JSON.stringify(selectedSeats);
            submitBtn.disabled = remaining > 0;
        });
    });
});
