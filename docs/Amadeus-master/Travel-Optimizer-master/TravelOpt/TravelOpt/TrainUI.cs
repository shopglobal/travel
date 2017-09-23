using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using TravelFactory;

namespace TravelFactory
{
    public partial class TrainUI : Form
    {
        public TrainUI()
        {
            InitializeComponent();
            //this.timesListBox.Items.Add("2014-10-13T06:32");
            //this.timesListBox.Items.Add("2014-10-13T14:32");
            //this.timesListBox.Items.Add("2014-10-13T17:3");
            //this.destinationList.Items.Add("8300035");
            //this.destinationList.Items.Add("8306421");
            //this.destinationList.Items.Add("8311145");
        }

        private void TrainUI_Load(object sender, EventArgs e)
        {
            getMethod();
        }

        private Label departureLabel;
    }
}
