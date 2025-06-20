using System.Buffers;
using System.Diagnostics;

public class ImageProcessor
{
    private const int IMAGE_WIDTH = 800;
    private const int IMAGE_HEIGHT = 600;
    private const int TOTAL_PIXELS = IMAGE_HEIGHT * IMAGE_WIDTH;
    private const int TOTAL_IMAGES = 500;

    public static void ProcessImages()
    {
        Console.WriteLine("Iniciando processamento de imagens (versão otimizada)...");

        var stopwatch = Stopwatch.StartNew();
        int processedCount = 0;
        var pool = ArrayPool<PixelRGB>.Shared;
        PixelRGB[] blurred = default!;
        PixelRGB[] imageArray = default!;
        try
        {
            blurred = pool.Rent(TOTAL_PIXELS);
            imageArray = pool.Rent(TOTAL_PIXELS);

            for (int imageIndex = 0; imageIndex < TOTAL_IMAGES; imageIndex++)
            {
                GenerateSyntheticImage(imageIndex, imageArray);
                ApplyBlurFilter(imageArray, blurred);

                SaveImage(blurred, $"processed_{imageIndex}.jpg");
                processedCount++;

                if (imageIndex % 50 == 0)
                {
                    Console.WriteLine($"Processadas {imageIndex} imagens...");
                }
            }
        }
        catch (Exception e)
        {
            Console.WriteLine($"Erro: {e.Message}");
        }
        finally
        {
            pool.Return(blurred);
            pool.Return(imageArray);
        }


        stopwatch.Stop();

        Console.WriteLine($"Processamento concluído!");
        Console.WriteLine($"Imagens processadas: {processedCount}");
        Console.WriteLine($"Tempo total: {stopwatch.ElapsedMilliseconds} ms");
        Console.WriteLine($"Tempo médio por imagem: {stopwatch.ElapsedMilliseconds / (double)processedCount:F2} ms");
    }

    private static void GenerateSyntheticImage(int seed, PixelRGB[] image)
    {
        var random = new Random(seed);
        for (int y = 0; y < IMAGE_HEIGHT - 1; y++)
        {
            int rowStart = y * IMAGE_WIDTH;
            for (int x = 0; x < IMAGE_WIDTH - 1; x++)
            {
                image[rowStart + x] = new PixelRGB(
                    (byte)random.Next(256),
                    (byte)random.Next(256),
                    (byte)random.Next(256)
                );
            }
        }
    }

    private static void ApplyBlurFilter(PixelRGB[] original, PixelRGB[] blurred)
    {
        for (int y = 0; y < IMAGE_HEIGHT - 1; y++)
        {
            int rowStart = y * IMAGE_WIDTH;
            int nextRowStart = (y + 1) * IMAGE_WIDTH;
            for (int x = 0; x < IMAGE_WIDTH - 1; x++)
            {
                blurred[y * IMAGE_WIDTH + x] = PixelRGB.Average(
                    original[rowStart + x],
                    original[rowStart + x + 1],
                    original[nextRowStart + x],
                    original[nextRowStart + x + 1]
                );
            }
        }
    }

    private static void SaveImage(PixelRGB[] image, string filename)
    {
        // Simula salvamento - na prática salvaria em disco
        // Para o exercício, apenas dar print
    }
}
