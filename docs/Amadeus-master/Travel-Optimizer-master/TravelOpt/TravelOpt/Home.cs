using Npgsql;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using pg_data;

using TravelFactory;

namespace TravelOpt
{
    public partial class Home : Form
    {
        private String _user_id;
        private Dictionary<String, String> _airportBindData;
        private Dictionary<String, String> _trainBindData;
        private KeyValuePair<String, String> _selectedAirport;
        private KeyValuePair<String, String> _selectedRailroad;
        private DateTime _departureDate;
        private DateTime _returnDate;
        private String _selectedTransportation;
        private int _maxPrice;

        public Dictionary<String, String> AirportBindData { get { return _airportBindData; } set { _airportBindData = value; } }
        public Dictionary<String, String> TrainBindData { get { return _trainBindData; } set { _trainBindData = value; } }
        public DateTime DepartureDate { get { return _departureDate; } set { _departureDate = value; } }
        public DateTime ReturnDate { get { return _returnDate; } set { _returnDate = value; } }


        public Home(String user_id)
        {
            _selectedTransportation = "";
            _maxPrice = 0;
            this._user_id = user_id;
            InitializeComponent();
            populateAirportBindData();
            populateTrainBindData();
        }

        private void populateAirportBindData()
        {

            DbQuery db = new DbQuery("SELECT name, acronym FROM hack.city;");
            db.execute();
            List<Dictionary<String, String>> result = db.results;
            _airportBindData = new Dictionary<string, string>();

            for (int i = 0; i < result.Count; i++)
            {
                try
                {
                    //Console.WriteLine("name: " + result[i]["name"]);
                    //Console.WriteLine("acronym: " + result[i]["acronym"]);
                    if(!_airportBindData.ContainsKey((String)result[i]["name"]))
                    {
                        _airportBindData.Add((String)result[i]["name"], (String)result[i]["acronym"]);
                    }
                }
                catch (Exception exp)
                {
                    //MessageBox.Show("The error is: " + exp);
                }
            }
            this.airportCombo.DataSource = new BindingSource(_airportBindData, null);
            this.airportCombo.DisplayMember = "name";
        }

        private void populateTrainBindData()
        {

            DbQuery db = new DbQuery("SELECT name, station_id FROM hack.train_info;");
            db.execute();
            List<Dictionary<String, String>> result = db.results;
            _trainBindData = new Dictionary<string, string>();

            Console.WriteLine("The count of users is: " + result[0]["name"]);

            for (int i = 0; i < result.Count; i++)
            {
                try
                {
                    if(!_trainBindData.ContainsKey((String)result[i]["name"]))
                    {
                        _trainBindData.Add((String)result[i]["name"], (String)result[i]["station_id"]);
                    }
                    
                }
                catch (Exception exp)
                {
                    //MessageBox.Show("The error is: " + exp);
                }
            }
            this.trainCombo.DataSource = new BindingSource(_trainBindData, null);
            this.trainCombo.DisplayMember = "name";
        }

        private void Observer_Load(object sender, EventArgs e)
        {

        }

        private void departureDate_ValueChanged(object sender, EventArgs e)
        {
            DateTime today = DateTime.Now;
            
            if (this.departureDate.Value.ToLocalTime() >= today)
            {
                _departureDate = this.departureDate.Value.ToLocalTime();
            }
            else
            {
                MessageBox.Show("Please specify after a day after today");
            }
            
        }

        private void returnDate_ValueChanged(object sender, EventArgs e)
        {
            DateTime today = DateTime.Now;
            
            if (this.returnDate.Value.ToLocalTime() >= today)
            {
                _returnDate = this.returnDate.Value.ToLocalTime();
            }
            else
            {
                MessageBox.Show("Please specify after today");
            }
        }

        private void travelBtn_Click(object sender, EventArgs e)
        {
            String errorMsg = "No Error";
            if(_returnDate.ToLocalTime() <= DateTime.Now || _departureDate >= _returnDate)
            {
                errorMsg = "Please specify a departure and return date after today";
            }
            if (_selectedTransportation == "")
            {
                errorMsg = "Please select an airport or a railroad station";
            }
            if (_selectedTransportation == "airport" && _maxPrice <= 0)
            {
                errorMsg = "Please place your maximum price you're willing to pay in the budget box.";
            }

            if (errorMsg == "No Error")
            {
                if (_selectedTransportation == "airport")
                {
                    new Receiver(_departureDate, _returnDate, _selectedAirport.Value, _maxPrice.ToString()).getTransport(_selectedTransportation);
                }
                else if (_selectedTransportation == "railroad")
                {
                    new Receiver(_departureDate, _selectedRailroad.Value, _maxPrice.ToString()).getTransport(_selectedTransportation);
                }
                //else
                //{
                //    ApiParser parse = new ApiParser(_departureDate, _selectedRailroad.Value, _maxPrice.ToString());
                //    List<Train> trains = parse.getTrains();
                //}
            }
            else
            {
                MessageBox.Show(errorMsg);
            }
        }

        private void airportCombo_SelectedIndexChanged(object sender, EventArgs e)
        {
            _selectedTransportation = "airport";
            foreach (KeyValuePair<string, string> airport in _airportBindData)
            {
                if(this.airportCombo.Text == airport.ToString())
                {
                    _selectedAirport = airport;
                }
            }
        }

        private void trainCombo_SelectedIndexChanged(object sender, EventArgs e)
        {
            _selectedTransportation = "railroad";
            foreach (KeyValuePair<string, string> station in _trainBindData)
            {
                if (this.trainCombo.Text == station.ToString())
                {
                    _selectedRailroad = station;
                }
            }
        }

        private void maxCostInput_TextChanged(object sender, EventArgs e)
        {
            int temp;
            if (Int32.TryParse(this.maxCostInput.Text, out temp))
            {
                _maxPrice = temp;
            }
            else
            {
                MessageBox.Show("Please select a numeric value");
                maxCostInput.Clear();
            }
            
                
        }
    }
}
