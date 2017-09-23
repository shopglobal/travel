namespace TravelOpt
{
    partial class AirplaneUI
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

        #endregion

        private System.Windows.Forms.ListBox destinationList;
        private System.Windows.Forms.ListBox timesListBox;
        private System.Windows.Forms.Label destinationLabel;
        private System.Windows.Forms.Label departureLabel;
    }
}