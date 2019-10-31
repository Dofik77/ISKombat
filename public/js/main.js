function showPage(name) {
    document.getElementById("authPage").style.display = "none";
    document.getElementById("gamePage").style.display = "none";
    document.getElementById("lobbyPage").style.display = "none";
    document.getElementById(name).style.display = "block";
}

window.onload = function () {
    const server = new Server();
    //authorization
    this.showPage("authPage");
    async function initLobbyPage(token) {
        const result = await server.getAllUsers(token);
        if (result) {
            console.log(result);
        }
        //TODO: output user login
        //TODO: list of users (online, and then offline)
    }
    document.getElementById("loginButton").addEventListener("click", async function() {
        const login = document.getElementById("login").value;
        const pass = document.getElementById("pass").value;
        if (login && pass) {
            const result = await server.auth(login, pass);
            if (result) {
                showPage("lobbyPage");
                initLobbyPage(result.token);
            }
        }else alert("no login or pass");
    });
    document.getElementById("registerButton").addEventListener("click", async function() {
        const login = document.getElementById("login").value;
        const pass = document.getElementById("pass").value;
        if (login && pass) {
            const result = await server.register(login, pass);
            if (result) {
                alert("success! now login!");
            }
        }else alert("no login or pass");
    });
    document.getElementById("logoutButton").addEventListener("click", async function() {
            const result = await server.logout();
            if (result) {
                showPage("authPage");
            }
    });
    //game methods
    document.getElementById('move_right').addEventListener('click', async function () {
        console.log(await server.move(0, "right"));
    });

    document.getElementById('move_left').addEventListener('click', async function () {
        console.log(await server.move(0, "left"));
    });

    document.getElementById('hit_hand').addEventListener('click', async function () {
        console.log(await server.hit(0, "HANDKICK"));
    });

    document.getElementById('hit_leg').addEventListener('click', async function () {
        console.log(await server.hit(0, "LEGKICK"));
    });

    document.getElementById('stand').addEventListener('click', async function () {
        console.log(await server.setState(0, "STANDING"));
    });

    document.getElementById('crouch').addEventListener('click', async function () {
        console.log(await server.setState(0, "CROUCHING"));
    });

    document.getElementById('jump').addEventListener('click', async function () {
        console.log(await server.setState(0, "JUMP"));
    });
};
