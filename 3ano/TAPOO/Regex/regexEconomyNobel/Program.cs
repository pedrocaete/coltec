using System.Text.RegularExpressions;

string json = File.ReadAllText("prize.json");

string pattern = @"""category"":""economics"".*?""laureates"":\s*\[(.*?)\]";
MatchCollection matches = Regex.Matches(json, pattern, RegexOptions.Singleline);

List<string> names = new List<string>();

foreach (Match match in matches)
{
    string contentLaureates = match.Groups[1].Value;

    string namePattern = @"""firstname"":""([^""]+)""";
    MatchCollection namesMatches = Regex.Matches(contentLaureates, namePattern);

    foreach (Match nameMatch in namesMatches)
    {
        string name = nameMatch.Groups[1].Value;
        names.Add(name);
    }
}

Console.WriteLine("Ganhadores do Nobel de Economia:");
foreach (string name in names)
{
    Console.WriteLine(name);
}
