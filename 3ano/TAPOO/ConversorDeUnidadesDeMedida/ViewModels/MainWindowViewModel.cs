using System;
using System.Collections.ObjectModel;
using System.ComponentModel;
using System.Runtime.CompilerServices;
using System.Windows.Input;
using ConversorDeUnidadesDeMedida.Models;
using ConversorDeUnidadesDeMedida.Services;

namespace ConversorDeUnidadesDeMedida.ViewModels
{
    public class MainWindowViewModel : INotifyPropertyChanged
    {
        public ObservableCollection<ConversionType> ConversionTypes { get; }
        private ConversionType _selectedConversionType = null!;
        public ConversionType SelectedConversionType
        {
            get => _selectedConversionType;
            set
            {
                _selectedConversionType = value;
                OnPropertyChanged();
            }
        }

        private string _inputValue = string.Empty;
        public string InputValue
        {
            get => _inputValue;
            set
            {
                _inputValue = value;
                OnPropertyChanged();
            }
        }

        private string _outputValue = string.Empty;
        public string OutputValue
        {
            get => _outputValue;
            set
            {
                _outputValue = value;
                OnPropertyChanged();
            }
        }

        public ICommand ConvertCommand { get; }

        public MainWindowViewModel()
        {
            ConversionTypes = new ObservableCollection<ConversionType>(ConversionService.GetConversionTypes());
            ConvertCommand = new RelayCommand(ExecuteConversion);
        }

        private void ExecuteConversion()
        {
            if (double.TryParse(InputValue, out double input) && SelectedConversionType != null)
            {
                OutputValue = SelectedConversionType.ConversionFormula(input).ToString("F2");
            }
            else
            {
                OutputValue = "Entrada inválida";
            }
        }

        public event PropertyChangedEventHandler? PropertyChanged;

        protected void OnPropertyChanged([CallerMemberName] string? propertyName = null)
        {
            PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(propertyName));
        }
    }

    public class RelayCommand : ICommand
    {
        private readonly Action _execute;

        public RelayCommand(Action execute)
        {
            _execute = execute;
        }

        public event EventHandler? CanExecuteChanged
        {
            add { }
            remove { }
        }

        public bool CanExecute(object? parameter) => true;

        public void Execute(object? parameter) => _execute();
    }
}