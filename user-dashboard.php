<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user-dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
        integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <title>User Dashboard</title>
</head>

<body>
    <input type="checkbox" id="navigation-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h1><i class='bx bx-pointer'></i><span>Press Point</span></h1>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="user-dashboard.php" class="active"><i class='bx bx-user-circle'></i>
                        <span>Account Settings</span></a>
                </li>
                <li>
                    <a href="order-history.php"><i class='bx bx-history'></i>
                        <span>Order History</span></a>
                </li>
                <li>
                    <a id="signout-button"><i class='bx bx-log-out'></i>
                        <span>Sign Out</span></a>
                </li>
                <div class="background"></div>
                <div class="alert-box" id="signout-alert">
                    <div class="icon">
                        <i class='bx bx-help-circle'></i>
                    </div>
                    <p>Are you sure you want to sign out?</p>
                    <div class="buttons">
                        <button id="confirm-signout" class="button">Yes, Sign Out</button>
                        <button id="cancel-signout" class="button">Cancel</button>
                    </div>
                </div>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <h1><label for="navigation-toggle"><i class='bx bx-menu'></i></label>Dashboard</h1>
            <div class="user-wrapper">
                <div>
                    <h5>Andrei Marvin Roque</h5>
                    <small>User</small>
                </div>
            </div>
        </header>
        <main>
            <div class="recent-grid">
                <h1>Account Settings</h1>
                <div class="form-section">
                    <form>
                        <input type="text" placeholder="Full Name" required>
                        <input type="tel" placeholder="Contact Number" pattern="^[0-9]+$" id="contact-number" required>
                        <input type="text" placeholder="Address" required>
                        <button type="submit">Save Changes</button>
                    </form>
                </div>
            </div>
        </main>

        <div class="background" id="save-background"></div>
        <div class="alert-box" id="save-alert">
            <div class="icon">
                <i class='bx bx-help-circle'></i>
            </div>
            <p>Are you sure you want to save these changes?</p>
            <div class="buttons">
                <button id="confirm-save" class="button">Yes, Save</button>
                <button id="cancel-save" class="button">Cancel</button>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const signoutButton = document.getElementById('signout-button');
            const signoutAlert = document.getElementById('signout-alert');
            const signoutBackground = document.querySelector('.background');
            const confirmSignoutButton = document.getElementById('confirm-signout');
            const cancelSignoutButton = document.getElementById('cancel-signout');

            const accountForm = document.querySelector('form');
            const saveAlert = document.getElementById('save-alert');
            const saveBackground = document.getElementById('save-background');
            const confirmSaveButton = document.getElementById('confirm-save');
            const cancelSaveButton = document.getElementById('cancel-save');

            signoutButton.addEventListener('click', () => {
                signoutAlert.classList.add('show');
                signoutBackground.classList.add('show');
            });

            confirmSignoutButton.addEventListener('click', () => {
                window.location.href = 'sign-in.html';
            });

            cancelSignoutButton.addEventListener('click', () => {
                signoutAlert.classList.remove('show');
                signoutBackground.classList.remove('show');
            });

            signoutBackground.addEventListener('click', () => {
                signoutAlert.classList.remove('show');
                signoutBackground.classList.remove('show');
            });

            accountForm.addEventListener('submit', (e) => {
                e.preventDefault();
                saveAlert.classList.add('show');
                saveBackground.classList.add('show');
            });

            confirmSaveButton.addEventListener('click', () => {
                saveAlert.classList.remove('show');
                saveBackground.classList.remove('show');
                accountForm.submit();
            });

            cancelSaveButton.addEventListener('click', () => {
                saveAlert.classList.remove('show');
                saveBackground.classList.remove('show');
            });

            saveBackground.addEventListener('click', () => {
                saveAlert.classList.remove('show');
                saveBackground.classList.remove('show');
            });
        });
        document.getElementById('contact-number').addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>

</body>

</html>