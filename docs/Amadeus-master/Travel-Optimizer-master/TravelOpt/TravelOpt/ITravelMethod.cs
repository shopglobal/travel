using System;
using System.Collections.Generic;
using TravelOpt;

namespace TravelFactory
{
    public interface ITravelMethod
    {
        String getMethod();
        void getLocations();
        void addLocationsToList();
    }

    public enum TransportType
    {
        airplane,
        train
    }

    public partial class AirplaneUI : System.Windows.Forms.Form, ITravelMethod
    {
        private List<String> _locations = new List<String> { };
        private List<String> _departureTimes = new List<String> { };
        private List<Airplane> _planes = new List<Airplane> { };
        private System.Windows.Forms.ListBox destinationList;
        private System.Windows.Forms.ListBox timesListBox;
        private System.Windows.Forms.Label destinationLabel;
        private System.Windows.Forms.Label departureLabel;
        public AirplaneUI()
        {
            InitializeComponent();
        }

        public AirplaneUI(List<Airplane> planes)
        {
            InitializeComponent();
            _planes = planes;
            getLocations();
            addLocationsToList();
        }

        public void getLocations()
        {
            foreach (var plane in _planes)
            {
                if (plane.Destination != "")
                {
                    _locations.Add(plane.Destination);
                    _departureTimes.Add(plane.DepartureDay);
                }
            }
        }

        public void addLocationsToList()
        {
            foreach (var plane in _planes)
            {
                if (plane.Destination != "")
                {
                    this.destinationList.Items.Add(plane.Destination);
                    this.timesListBox.Items.Add(plane.DepartureDay);
                }
            }
        }

        public String getMethod()
        {
            return "Airplane";
        }
        
        private void AirplaneUI_Load(object sender, EventArgs e)
        {

        }
        private void InitializeComponent()
        {
            this.destinationList = new System.Windows.Forms.ListBox();
            this.timesListBox = new System.Windows.Forms.ListBox();
            this.destinationLabel = new System.Windows.Forms.Label();
            this.departureLabel = new System.Windows.Forms.Label();
            this.SuspendLayout();
            // 
            // destinationList
            // 
            this.destinationList.FormattingEnabled = true;
            this.destinationList.Location = new System.Drawing.Point(228, 40);
            this.destinationList.Name = "destinationList";
            this.destinationList.Size = new System.Drawing.Size(156, 420);
            this.destinationList.TabIndex = 7;
            // 
            // timesListBox
            // 
            this.timesListBox.FormattingEnabled = true;
            this.timesListBox.Location = new System.Drawing.Point(12, 40);
            this.timesListBox.Name = "timesListBox";
            this.timesListBox.Size = new System.Drawing.Size(156, 420);
            this.timesListBox.TabIndex = 6;
            // 
            // destinationLabel
            // 
            this.destinationLabel.AutoSize = true;
            this.destinationLabel.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.destinationLabel.Location = new System.Drawing.Point(254, 9);
            this.destinationLabel.Name = "destinationLabel";
            this.destinationLabel.Size = new System.Drawing.Size(109, 25);
            this.destinationLabel.TabIndex = 5;
            this.destinationLabel.Text = "Destination";
            // 
            // departureLabel
            // 
            this.departureLabel.AutoSize = true;
            this.departureLabel.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.departureLabel.Location = new System.Drawing.Point(11, 9);
            this.departureLabel.Name = "departureLabel";
            this.departureLabel.Size = new System.Drawing.Size(157, 25);
            this.departureLabel.TabIndex = 4;
            this.departureLabel.Text = "Departure Times";
            // 
            // AirplaneUI
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.SystemColors.ActiveCaption;
            this.ClientSize = new System.Drawing.Size(397, 470);
            this.Controls.Add(this.destinationList);
            this.Controls.Add(this.timesListBox);
            this.Controls.Add(this.destinationLabel);
            this.Controls.Add(this.departureLabel);
            this.Name = "AirplaneUI";
            this.Text = "AirplaneUI";
            this.Load += new System.EventHandler(this.AirplaneUI_Load);
            this.ResumeLayout(false);
            this.PerformLayout();
        }
    }
                
    public partial class TrainUI : System.Windows.Forms.Form, ITravelMethod
    {
        private List<String> _locations = new List<String> { };
        private List<String> _departureTimes = new List<String> { };
        private List<Train> _trains;

        public TrainUI(List<Train> trains)
        {
            InitializeComponent();
            _trains = trains;
            getLocations();
            addLocationsToList();
        }

        public String getMethod()
        {
            return "Train *CHOO CHOO*";
        }
        public void getLocations()
        {
            foreach (var train in _trains)
            {
                if(train.Destination != "")
                {
                    _locations.Add(train.Destination);
                    _departureTimes.Add(train.ChildDepartureDay);
                }
            }
        }
        public void addLocationsToList()
        {
            foreach (var train in _trains)
            {
                if(train.Destination != "")
                {
                    this.destinationList.Items.Add(train.Destination);
                    this.timesListBox.Items.Add(train.ChildDepartureDay);
                }
            }
        }
    }

    public class transportFactory
    {
        public System.Windows.Forms.Form getTransport(TransportType type, List<Train> trains, List<Airplane> airplanes)
        {
            switch (type)
            {
                case TransportType.airplane:
                    return new AirplaneUI(airplanes);
                case TransportType.train:
                    return new TrainUI(trains);
                default:
                    throw new NotSupportedException();
            }
        }
    }
}
