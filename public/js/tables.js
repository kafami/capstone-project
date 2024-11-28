let eventsData = [];

function fetchEvents() {
    return fetch('/api/events')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log("Fetched Events:", data);
            if (!Array.isArray(data)) {
                console.error("Fetched data is not an array:", data);
                return [];
            }
            return data;
        })
        .catch(error => {
            console.error("Error fetching events:", error);
            return []; 
        });
}

fetchEvents().then(events => {
    console.log("Fetched Events:", events);
    eventsData = events;
    updateTable(eventsData); 
});

document.getElementById("view").addEventListener("change", function() {
    updateTable(eventsData);
});

let roomNames = [];

function fetchRooms() {
    return fetch('/api/rooms')
        .then(response => response.json())
        .then(data => {
            roomNames = data.map(room => room.name);
            console.log("Fetched Rooms:", roomNames);
        })
        .catch(error => console.error("Error fetching rooms:", error));
}

fetchRooms().then(() => {
    
    fetchEvents().then(events => {
        updateTable(events);
    });
});


function updateTable(events) {
    console.log("updateTable function called");
    const currentDateInput = document.getElementById('current-date-input');
    console.log("Current date input value:", currentDateInput.value);
    let currentDate = new Date(currentDateInput.value);
    currentDate.setDate(currentDate.getDate() + 1); 
    currentDate.setHours(0, 0, 0, 0);
    const currentDateString = currentDate.toISOString().split('T')[0];

    if (!Array.isArray(events)) {
        console.error("Events data is not an array:", events);
        return;
    }

    events = events.filter(event => event.status === 'accepted');

    var viewDropdown = document.getElementById("view");
    var selectedView = viewDropdown ? viewDropdown.value : "day";

    var headerRow = document.getElementById("headerRow");
    var tableBody = document.getElementById("tableBody");

    if (!headerRow || !tableBody) {
        console.error("Table elements not found.");
        return;
    }

    function timeToMinutes(time) {
        if (!time) return 0;
        var parts = time.split(":");
        return parseInt(parts[0]) * 60 + parseInt(parts[1]);
    }

    function createTimeSlots() {
        var slots = [];
        for (var hour = 8; hour <= 18; hour++) {
            slots.push((hour < 10 ? '0' : '') + hour + ":00");
            if (hour < 18) {
                slots.push((hour < 10 ? '0' : '') + hour + ":30");
            }
        }
        return slots;
    }

    headerRow.innerHTML = "";
    tableBody.innerHTML = "";

    if (selectedView === "day") {
        headerRow.insertAdjacentHTML("beforeend", "<th>Time</th>");
        roomNames.forEach(roomName => {
            headerRow.insertAdjacentHTML("beforeend", `<th>${roomName}</th>`);
        });

        var slots = createTimeSlots();


        let spannedCells = {};

        slots.forEach((slot) => {
            let row = `<tr><td>${slot}</td>`;
            
            roomNames.forEach(roomName => {
                // Pass currentDateString to openPopup
                let cell = `<td onclick="openPopup('${roomName}', '${slot}', '${currentDateString}')"></td>`;
                
                events.forEach(event => {
                    if (event && event.room === roomName && event.booking_date === currentDateString) {
                        const eventStart = timeToMinutes(event.start);
                        const eventEnd = timeToMinutes(event.end) + 30; // Adjust eventEnd to include the final slot
                        const slotTime = timeToMinutes(slot);
        
                        if (slotTime >= eventStart && slotTime < eventEnd) {
                            if (slotTime === eventStart && !spannedCells[`${event.room}-${eventStart}`]) {
                                const rowSpan = Math.ceil((eventEnd - eventStart) / 30);
        
                                cell = `<td rowspan="${rowSpan}" class="event ${event.cssClass || ''}" onclick="showEventDetails(${parseInt(event.id)}, '${event.name}', '${event.role}')">${event.title || ''}</td>`;
                                
                                spannedCells[`${event.room}-${eventStart}`] = true;
                            } else {
                                cell = "";
                            }
                        }
                    }
                });
        
                row += cell;
            });
        
            row += "</tr>";
            tableBody.insertAdjacentHTML("beforeend", row);
        });
        
        
        
    } else if (selectedView === "week") {
        headerRow.insertAdjacentHTML("beforeend", "<th>Room</th>");
        const weekDays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        weekDays.forEach(day => {
            headerRow.insertAdjacentHTML("beforeend", `<th>${day}</th>`);
        });

        roomNames.forEach(roomName => {
            var row = `<tr><td>${roomName}</td>`;
            weekDays.forEach(day => {
                let cell = "<td></td>";
                events.forEach(event => {
                    if (event && event.room === roomName && new Date(event.booking_date).getDay() === weekDays.indexOf(day) + 1) {
                        cell = `<td class="event ${event.cssClass || ''}" onclick="showEventDetails(${parseInt(event.id)}, '${event.name}', '${event.role}')">${event.title || ''}</td>`;
                    }
                });
                row += cell;
            });
            row += "</tr>";
            tableBody.insertAdjacentHTML("beforeend", row);
        });
    } else if (selectedView === "month") {
        headerRow.insertAdjacentHTML("beforeend", "<th>Room</th>");
        const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
        for (let day = 1; day <= daysInMonth; day++) {
            headerRow.insertAdjacentHTML("beforeend", `<th>${day}</th>`);
        }

        roomNames.forEach(roomName => {
            var row = `<tr><td>${roomName}</td>`;
            for (let day = 1; day <= daysInMonth; day++) {
                let cell = "<td></td>";
                events.forEach(event => {
                    const eventDate = new Date(event.booking_date);
                    if (event && event.room === roomName && eventDate.getDate() === day && eventDate.getMonth() === currentDate.getMonth()) {
                        cell = `<td class="event ${event.cssClass || ''}" onclick="showEventDetails(${parseInt(event.id)}, '${event.name}', '${event.role}')">${event.title || ''}</td>`;
                    }
                });
                row += cell;
            }
            row += "</tr>";
            tableBody.insertAdjacentHTML("beforeend", row);
        });
    }
}



function showEventDetails(eventId, name, role) {
    if (!eventId) {
        console.error("Event ID not found.");
        return;
    }

    const event = eventsData.find(e => e.id === eventId);

    if (event) {
        document.getElementById('modalEventTitle').textContent = event.title || 'Event Details';
        document.getElementById('modalEventRoom').textContent = event.room || 'N/A';
        document.getElementById('modalEventName').textContent = name || 'N/A';
        document.getElementById('modalEventRole').textContent = role || 'N/A';
        document.getElementById('modalEventDate').textContent = event.booking_date || 'N/A';
        document.getElementById('modalEventStartTime').textContent = event.start || 'N/A';
        document.getElementById('modalEventEndTime').textContent = event.end || 'N/A';
        document.getElementById('modalEventDescription').textContent = event.description || 'N/A';
        document.getElementById('modalEventStatus').textContent = event.status || 'N/A';

        document.getElementById('eventModal').style.display = 'block';
    } else {
        console.error("Event not found for ID:", eventId);
    }
}

function closeModal() {
    document.getElementById('eventModal').style.display = 'none';
}

window.addEventListener('click', function (event) {
    const modal = document.getElementById('eventModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

function openPopup(room, time, currentDate) {
    const popup = document.getElementById('popup');
    const roomInput = document.getElementById('ruangan');
    const timeInput = document.getElementById('starttime');
    const dateInput = document.getElementById('bookingdate');

    // Use the passed currentDate without any fallback or overwrite
    console.log("Room:", room);
    console.log("Time:", time);
    console.log("Current Date (passed):", currentDate);

    // Set the input values
    if (roomInput) roomInput.value = room;
    if (timeInput) timeInput.value = time;
    if (dateInput) dateInput.value = currentDate; // Directly use currentDate

    // Show the popup
    popup.classList.remove('hidden');
}

