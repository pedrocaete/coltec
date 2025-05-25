var console = new SystemConsole();
var table = new Table(console);
var menu = new Menu(console, table);

menu.Show();

var server = new Server(15000);

while (!table.IsGameWin())
{
    var message = server.Receive();

    var attackStatus = table.ReceiveAttack(message);
    server.Send(attackStatus);
}
