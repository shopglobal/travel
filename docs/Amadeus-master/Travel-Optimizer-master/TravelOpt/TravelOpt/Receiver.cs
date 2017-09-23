using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using TravelFactory;

namespace TravelOpt
{
    public class Receiver
    {
        private DateTime _departureDate;
        private DateTime _returnDate;
        private String _origin;
        private String _maxPrice;

        public Receiver(DateTime departureDate, String origin, String maxPrice)
        {
            _departureDate = departureDate;
            _origin = origin;
            _maxPrice = maxPrice;
        }

        public Receiver(DateTime departureDate, DateTime returnDate, String origin, String maxPrice)
        {
            _departureDate = departureDate;
            _returnDate = returnDate;
            _origin = origin;
            _maxPrice = maxPrice;
        }

        public void getTransport(String transport)
        {
            Train tempTrain = new Train();
            Airplane tempAirplane = new Airplane();
            ApiParser parse = new ApiParser();
            List<Train> trains = new List<Train> { };
            List<Airplane> airplanes = new List<Airplane> { };

            if (transport == "railroad")
            {
                trains = parse.getTrains(_departureDate, _origin, _maxPrice);
                transportFactory trainSubject = new transportFactory();
                TransportType method = TransportType.train;
                Form modal = trainSubject.getTransport(method, trains, null);
                modal.Show();
               // TrainUI trainSubject = new TrainUI(trains);
               //trainSubject.Show();
            }
            else if(transport == "airport")
            {
                airplanes = parse.getPlanes(_departureDate, _returnDate, _origin, _maxPrice);
                transportFactory planeSubject = new transportFactory();
                TransportType method = TransportType.airplane;
                Form modal = planeSubject.getTransport(method, null, airplanes);
                if (airplanes.Count >= 1)
                {
                    modal.Show();
                }
                else
                {
                    MessageBox.Show("There were no results for your specified search!");
                }
        }
        }
    }
}
