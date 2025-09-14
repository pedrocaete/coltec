using Microsoft.Xna.Framework;
using Microsoft.Xna.Framework.Graphics;
using Microsoft.Xna.Framework.Input;

namespace IntroducaoSprites;

public class Game1 : Game
{
    private GraphicsDeviceManager _graphics;
    private SpriteBatch _spriteBatch;

    private Texture2D _idleSheet;
    private Texture2D _walkSheet;

    private enum CharacterState
    {
        Idle,
        Walking,
    }

    private CharacterState _currentState = CharacterState.Idle;

    private enum Direction
    {
        Front = 0,
        Back = 1,
        Side = 2,
    }

    private Direction _currentDirection = Direction.Front;

    private Vector2 _position = new Vector2(100, 100);

    private int _currentFrame = 0;
    private int _totalFrames;
    private float _animationSpeed = 0.1f;
    private float _timer = 0f;

    private SpriteEffects effects = SpriteEffects.None;

    private const int FRAME_WIDTH = 32;
    private const int FRAME_HEIGHT = 32;
    private const int IDLE_FRAMES_COUNT = 4;
    private const int WALK_FRAMES_COUNT = 6;

    private float acelleration = 0.0f;

    private bool _isInLimbo = false;
    private float _limboTimer = 0f;
    private const float LIMBO_DURATION = 600.0f;

    public Game1()
    {
        _graphics = new GraphicsDeviceManager(this);
        Content.RootDirectory = "Content";
        IsMouseVisible = true;
    }

    protected override void Initialize()
    {
        // TODO: Add your initialization logic here

        base.Initialize();
    }

    protected override void LoadContent()
    {
        _spriteBatch = new SpriteBatch(GraphicsDevice);

        _idleSheet = Content.Load<Texture2D>("Idle");
        _walkSheet = Content.Load<Texture2D>("Walk");
    }

    protected override void Update(GameTime gameTime)
    {
        if (
            GamePad.GetState(PlayerIndex.One).Buttons.Back == ButtonState.Pressed
            || Keyboard.GetState().IsKeyDown(Keys.Escape)
        )
            Exit();

        var keyboardState = Keyboard.GetState();
        var movementDirection = Vector2.Zero;

        var screenWidth = _graphics.PreferredBackBufferWidth;
        var screenHeight = _graphics.PreferredBackBufferHeight;

        if (!_isInLimbo)
        {
            if (keyboardState.IsKeyDown(Keys.Right) || keyboardState.IsKeyDown(Keys.D))
            {
                _currentDirection = Direction.Side;
                movementDirection.X = 1;
            }
            else if (keyboardState.IsKeyDown(Keys.Left) || keyboardState.IsKeyDown(Keys.A))
            {
                _currentDirection = Direction.Side;
                movementDirection.X = -1;
            }

            if (keyboardState.IsKeyDown(Keys.Up) || keyboardState.IsKeyDown(Keys.W))
            {
                _currentDirection = Direction.Back;
                movementDirection.Y = -1;
            }
            else if (keyboardState.IsKeyDown(Keys.Down) || keyboardState.IsKeyDown(Keys.S))
            {
                _currentDirection = Direction.Front;
                movementDirection.Y = 1;
            }

            if (movementDirection != Vector2.Zero)
            {
                acelleration += 1.0f;
                _currentState = CharacterState.Walking;
                movementDirection.Normalize();
                _position +=
                    movementDirection * acelleration * (float)gameTime.ElapsedGameTime.TotalSeconds;
            }
            else
            {
                acelleration = 0;
                _currentState = CharacterState.Idle;
            }

            _timer += (float)gameTime.ElapsedGameTime.TotalSeconds;

            switch (_currentState)
            {
                case CharacterState.Idle:
                    _totalFrames = IDLE_FRAMES_COUNT;
                    break;
                case CharacterState.Walking:
                    _totalFrames = WALK_FRAMES_COUNT;
                    break;
            }

            if (_timer > _animationSpeed)
            {
                _currentFrame++;
                if (_currentFrame >= _totalFrames)
                {
                    _currentFrame = 0;
                }
                _timer = 0f;
            }

            if (
                _position.X > screenWidth
                || _position.X < -FRAME_WIDTH
                || _position.Y > screenHeight
                || _position.Y < -FRAME_HEIGHT
            )
            {
                _isInLimbo = true;
                _limboTimer = LIMBO_DURATION;
            }
        }
        else
        {
            if(acelleration == 0)
            {
                acelleration = 10;
            }
            _limboTimer -= acelleration * (float)gameTime.ElapsedGameTime.TotalSeconds;

            if (_limboTimer <= 0)
            {
                if (_position.X > screenWidth)
                    _position.X = -FRAME_WIDTH;
                else if (_position.X < -FRAME_WIDTH)
                    _position.X = screenWidth - FRAME_WIDTH;

                if (_position.Y > screenHeight)
                    _position.Y = -FRAME_HEIGHT;
                else if (_position.Y < -FRAME_HEIGHT)
                    _position.Y = screenHeight - FRAME_HEIGHT;

                _isInLimbo = false;
            }
        }

        base.Update(gameTime);
    }

    protected override void Draw(GameTime gameTime)
    {
        GraphicsDevice.Clear(Color.CornflowerBlue);

        Texture2D currentSheet;
        if (_currentState == CharacterState.Idle)
        {
            currentSheet = _idleSheet;
        }
        else
        {
            currentSheet = _walkSheet;
        }

        var sourceRectangle = new Rectangle(
            _currentFrame * FRAME_WIDTH,
            (int)_currentDirection * FRAME_HEIGHT,
            FRAME_WIDTH,
            FRAME_HEIGHT
        );

        if (Keyboard.GetState().IsKeyDown(Keys.Left))
        {
            effects = SpriteEffects.FlipHorizontally;
        }
        if (Keyboard.GetState().IsKeyDown(Keys.Right))
        {
            effects = SpriteEffects.None;
        }
        if ( (Keyboard.GetState().IsKeyDown(Keys.Left) || Keyboard.GetState().IsKeyDown(Keys.A)) && (Keyboard.GetState().IsKeyDown(Keys.Right) || Keyboard.GetState().IsKeyDown(Keys.D)) )
        {
            effects = SpriteEffects.FlipHorizontally;
        }

        if (!_isInLimbo)
        {
            _spriteBatch.Begin();

            _spriteBatch.Draw(
                currentSheet,
                _position,
                sourceRectangle,
                Color.White,
                0f,
                Vector2.Zero,
                2.0f,
                effects,
                0f
            );

            _spriteBatch.End();
        }

        base.Draw(gameTime);
    }
}
