using pg_data;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;

namespace TravelOpt
{
    public class Train : Transportation, Transport
    {
        private String _destination;
        public String Destination { get {return _destination; } set { _destination = value; } }

        //public DateTime ChildDepartureDay { get { return DepartureDay; } set { DepartureDay = value; } }
        public String ChildDepartureDay;

        public Train()
        {
            _destination = "";
            ChildDepartureDay = "";
        }

        public Train(String destinationSymbol, String departureTimes)
        {
            _destination = getDestination(destinationSymbol);
            //DepartureDay = departureTimes;
            ChildDepartureDay = departureTimes;
        }

        private String getDestination(String symbol)
        {
            String sql = "SELECT name FROM hack.train_info WHERE station_id = '" + symbol + "' LIMIT 1;";
            DbQuery db = new DbQuery(sql);
            db.execute();
            var destination = "";
            try
            {
               destination = db.results[0]["name"];
            }
            catch (Exception exp)
            {
                destination = "";
            }
            
            return destination;
        }

        public String apiComTest()
        {
            String test = "Test";
            return test;
        }
        //public String apiComTest()
        //{
        //    DepartureDay = Convert.ToDateTime("2016-11-13");
        //    Origin = "8302589";
        //    string apiUrl = _apiStart + _apiVersion + ApiMisc + "origin="+ Origin +"&departure_date=" + DepartureDay.ToString("yyyy-MM-dd") +"&apikey=" + _apiKey;
        //    Console.WriteLine(apiUrl);
        //    WebClient client = new WebClient();
        //    Stream stream = client.OpenRead(apiUrl);
        //    StreamReader reader = new StreamReader(stream);
        //    String content = reader.ReadToEnd();
        //    return content;
        //}
    }
}
