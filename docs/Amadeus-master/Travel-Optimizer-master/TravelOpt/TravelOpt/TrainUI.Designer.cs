namespace TravelFactory
{
    partial class TrainUI
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.departureLabel = new System.Windows.Forms.Label();
            this.destinationLabel = new System.Windows.Forms.Label();
            this.timesListBox = new System.Windows.Forms.ListBox();
            this.destinationList = new System.Windows.Forms.ListBox();
            this.SuspendLayout();
            // 
            // departureLabel
            // 
            this.departureLabel.AutoSize = true;
            this.departureLabel.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.departureLabel.Location = new System.Drawing.Point(54, 9);
            this.departureLabel.Name = "departureLabel";
            this.departureLabel.Size = new System.Drawing.Size(157, 25);
            this.departureLabel.TabIndex = 0;
            this.departureLabel.Text = "Departure Times";
            // 
            // destinationLabel
            // 
            this.destinationLabel.AutoSize = true;
            this.destinationLabel.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.destinationLabel.Location = new System.Drawing.Point(297, 9);
            this.destinationLabel.Name = "destinationLabel";
            this.destinationLabel.Size = new System.Drawing.Size(109, 25);
            this.destinationLabel.TabIndex = 1;
            this.destinationLabel.Text = "Destination";
            // 
            // timesListBox
            // 
            this.timesListBox.FormattingEnabled = true;
            this.timesListBox.Location = new System.Drawing.Point(55, 40);
            this.timesListBox.Name = "timesListBox";
            this.timesListBox.Size = new System.Drawing.Size(156, 420);
            this.timesListBox.TabIndex = 2;
            // 
            // destinationList
            // 
            this.destinationList.FormattingEnabled = true;
            this.destinationList.Location = new System.Drawing.Point(271, 40);
            this.destinationList.Name = "destinationList";
            this.destinationList.Size = new System.Drawing.Size(156, 420);
            this.destinationList.TabIndex = 3;
            // 
            // TrainUI
            // 
            this.BackColor = System.Drawing.SystemColors.ActiveCaption;
            this.ClientSize = new System.Drawing.Size(490, 472);
            this.Controls.Add(this.destinationList);
            this.Controls.Add(this.timesListBox);
            this.Controls.Add(this.destinationLabel);
            this.Controls.Add(this.departureLabel);
            this.Name = "TrainUI";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label destinationLabel;
        private System.Windows.Forms.ListBox timesListBox;
        private System.Windows.Forms.ListBox destinationList;
    }
}