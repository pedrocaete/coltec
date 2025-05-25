IConsole console = new SystemConsole();
console.WriteLine("Bem vindo ao jogo Batalha Naval!");
Client client = new("127.0.0.1", 15000);
AttackTable table = new(console, client);
table.Play();
client.Close();
