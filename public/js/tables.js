let eventsData = [];

// Function to fetch events from the server
function fetchEvents() {
    return fetch('/api/events') // Adjust the route if necessary
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log("Fetched Events:", data); // Log fetched data
            if (!Array.isArray(data)) {
                console.error("Fetched data is not an array:", data);
                return [];
            }
            return data; // Return data directly without modification
        })
        .catch(error => {
            console.error("Error fetching events:", error);
            return []; // Return an empty array on error
        });
}

fetchEvents().then(events => {
    console.log("Fetched Events:", events); // Log fetched data to check structure
    eventsData = events;
    updateTable(eventsData); // Now calling updateTable after data is fetched
});

// Update the table when the view dropdown changes
document.getElementById("view").addEventListener("change", function() {
    updateTable(eventsData);
});

// Room names for the table headers
const roomNames = ['A101', 'A102', 'A201', 'A202'];

function updateTable(events) {
    console.log("updateTable function called");
    const currentDateInput = document.getElementById('current-date-input');
    console.log("Current date input value:", currentDateInput.value);
    let currentDate = new Date(currentDateInput.value);
    const currentDateString = currentDate.toISOString().split('T')[0];  // Current date string

    if (!Array.isArray(events)) {
        console.error("Events data is not an array:", events);
        return;
    }

    var viewDropdown = document.getElementById("view");
    var selectedView = viewDropdown ? viewDropdown.value : "day";

    var headerRow = document.getElementById("headerRow");
    var tableBody = document.getElementById("tableBody");

    if (!headerRow || !tableBody) {
        console.error("Table elements not found.");
        return;
    }

    // Function to convert time to minutes
    function timeToMinutes(time) {
        if (!time) return 0;
        var parts = time.split(":");
        return parseInt(parts[0]) * 60 + parseInt(parts[1]);
    }

    // Function to create time slots (8:00 AM to 6:00 PM)
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

    // Clear existing table content
    headerRow.innerHTML = "";
    tableBody.innerHTML = "";

    if (selectedView === "day") {
        // Render headers
        headerRow.insertAdjacentHTML("beforeend", "<th>Time</th>");
        roomNames.forEach(roomName => {
            headerRow.insertAdjacentHTML("beforeend", `<th>${roomName}</th>`);
        });

        var slots = createTimeSlots();

        // Track cells that have already been spanned by rowSpan
        let spannedCells = {};

        // Render rows for each time slot
        slots.forEach((slot, slotIndex) => {
            var row = `<tr><td>${slot}</td>`;
            
            roomNames.forEach(roomName => {
                var cell = "<td></td>";  // Default empty cell

                events.forEach(event => {
                    // Check if the event room matches and the date matches
                    if (event && event.room === roomName && event.booking_date === currentDateString) {
                        const eventStart = timeToMinutes(event.start);
                        const eventEnd = timeToMinutes(event.end);
                        const slotTime = timeToMinutes(slot);

                        // Only add a cell with rowspan for the start time of the event
                        if (slotTime >= eventStart && slotTime < eventEnd) {
                            if (slotTime === eventStart && !spannedCells[`${event.room}-${eventStart}`]) {
                                const rowSpan = Math.ceil((eventEnd - eventStart) / 30);

                                // Define the event cell with the onclick handler
                                cell = `<td rowspan="${rowSpan}" class="event ${event.cssClass || ''}" onclick="showEventDetails(${parseInt(event.id)}, '${event.name}', '${event.role}')">${event.title || ''}</td>`;
                                
                                // Mark this cell as spanned to avoid duplicate rendering in subsequent slots
                                spannedCells[`${event.room}-${eventStart}`] = true;
                            } else {
                                cell = "";  // Leave blank for cells covered by rowspan
                            }
                        }
                    }
                });

                row += cell;
            });

            row += "</tr>";
            tableBody.insertAdjacentHTML("beforeend", row);
        });
    }
    
    // Add similar logic for week and month views if necessary...
}


function showEventDetails(eventId, name, role) {
    console.log("Event ID:", eventId); // Debugging log to ensure event ID is being passed
    console.log("Event Name:", name); // Debugging log to ensure event name is being passed
    console.log("Event Role:", role); // Debugging log to ensure event role is being passed
    if (eventId) {
        window.open(`/events/${eventId}`, '_blank');  // Open event details in a new tab
    } else {
        console.error("Event ID not found.");
    }
}