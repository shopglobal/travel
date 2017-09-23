using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;

namespace TravelOpt
{
    public class Airplane : Transportation, Transport
    {
        private const string _apiMisc = "/flights/inspiration-search?";
        private string _duration;
        private string _maxPrice;

        public Airplane()
        {
            _duration = "";
            _maxPrice = "";
        }

        public Airplane(int cost, string destination, string origin, string departureDay, string returnDay, string maxPrice)
        {
            Cost = cost;
            Destination = destination;
            Origin = origin;
            DepartureDay = departureDay;
            ReturnDay = returnDay;
            _duration = "";
            _maxPrice = maxPrice;
        }

        public Airplane(double cost, string destination, string origin, string departureDay, string returnDay)
        {
            Cost = cost;
            Destination = destination;
            Origin = origin;
            DepartureDay = departureDay;
            ReturnDay = returnDay;
            _duration = "";
        }

        public String apiComTest()
        {
            DepartureDay = "2016-11-06";
            ReturnDay = "2016-11-26";
            DateTime departureDay = Convert.ToDateTime(DepartureDay);
            DateTime returnDay = Convert.ToDateTime(ReturnDay);
            Origin = "BOS";
            //_duration = "7--9";
            _maxPrice = "500";
            _duration = (returnDay.Day - departureDay.Day) + "--" + (returnDay.Day - departureDay.Day + 3);
            if (returnDay.Day - departureDay.Day > 15)
            {
                _duration = "10--15";
            }
            string apiUrl = _apiStart + _apiVersion + _apiMisc + "origin=" + Origin + "&departure_date=" + departureDay.ToString("yyyy-MM-dd")+"--"+returnDay.ToString("yyyy-MM-dd") + "&duration=" + _duration + "&max_prcie=" + _maxPrice + "&apikey=" + _apiKey;
            Console.WriteLine(apiUrl);
            WebClient client = new WebClient();
            Stream stream = client.OpenRead(apiUrl);
            StreamReader reader = new StreamReader(stream);
            String content = reader.ReadToEnd();
            return content;
        }
    }
}
