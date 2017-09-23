namespace TravelOpt
{
    partial class LoginForm
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
            this.loginInGroupBox = new System.Windows.Forms.GroupBox();
            this.passwordLabel = new System.Windows.Forms.Label();
            this.userNameLabel = new System.Windows.Forms.Label();
            this.signInButton = new System.Windows.Forms.Button();
            this.passwordText = new System.Windows.Forms.TextBox();
            this.userNameText = new System.Windows.Forms.TextBox();
            this.loginLabel = new System.Windows.Forms.Label();
            this.signUpGroupBox = new System.Windows.Forms.GroupBox();
            this.retypePasswordLabel = new System.Windows.Forms.Label();
            this.newPasswordLabel = new System.Windows.Forms.Label();
            this.newEmailLabel = new System.Windows.Forms.Label();
            this.newUserNameLabel = new System.Windows.Forms.Label();
            this.signUpButton = new System.Windows.Forms.Button();
            this.newPassword2Text = new System.Windows.Forms.TextBox();
            this.newPassword1Text = new System.Windows.Forms.TextBox();
            this.newEmailText = new System.Windows.Forms.TextBox();
            this.newUsernameText = new System.Windows.Forms.TextBox();
            this.signUpLabel = new System.Windows.Forms.Label();
            this.loginFailedLabel = new System.Windows.Forms.Label();
            this.loginInGroupBox.SuspendLayout();
            this.signUpGroupBox.SuspendLayout();
            this.SuspendLayout();
            // 
            // loginInGroupBox
            // 
            this.loginInGroupBox.Controls.Add(this.loginFailedLabel);
            this.loginInGroupBox.Controls.Add(this.passwordLabel);
            this.loginInGroupBox.Controls.Add(this.userNameLabel);
            this.loginInGroupBox.Controls.Add(this.signInButton);
            this.loginInGroupBox.Controls.Add(this.passwordText);
            this.loginInGroupBox.Controls.Add(this.userNameText);
            this.loginInGroupBox.Controls.Add(this.loginLabel);
            this.loginInGroupBox.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.loginInGroupBox.Location = new System.Drawing.Point(12, 6);
            this.loginInGroupBox.Name = "loginInGroupBox";
            this.loginInGroupBox.Size = new System.Drawing.Size(368, 373);
            this.loginInGroupBox.TabIndex = 10;
            this.loginInGroupBox.TabStop = false;
            this.loginInGroupBox.Text = "Login";
            // 
            // passwordLabel
            // 
            this.passwordLabel.AutoSize = true;
            this.passwordLabel.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F);
            this.passwordLabel.Location = new System.Drawing.Point(75, 167);
            this.passwordLabel.Name = "passwordLabel";
            this.passwordLabel.Size = new System.Drawing.Size(78, 20);
            this.passwordLabel.TabIndex = 14;
            this.passwordLabel.Text = "Password";
            // 
            // userNameLabel
            // 
            this.userNameLabel.AutoSize = true;
            this.userNameLabel.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F);
            this.userNameLabel.Location = new System.Drawing.Point(75, 101);
            this.userNameLabel.Name = "userNameLabel";
            this.userNameLabel.Size = new System.Drawing.Size(83, 20);
            this.userNameLabel.TabIndex = 13;
            this.userNameLabel.Text = "Username";
            // 
            // signInButton
            // 
            this.signInButton.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.signInButton.Location = new System.Drawing.Point(124, 255);
            this.signInButton.Name = "signInButton";
            this.signInButton.Size = new System.Drawing.Size(121, 49);
            this.signInButton.TabIndex = 12;
            this.signInButton.Text = "Login";
            this.signInButton.UseVisualStyleBackColor = true;
            this.signInButton.Click += new System.EventHandler(this.signInButton_Click);
            // 
            // passwordText
            // 
            this.passwordText.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.passwordText.Location = new System.Drawing.Point(99, 190);
            this.passwordText.Name = "passwordText";
            this.passwordText.Size = new System.Drawing.Size(171, 30);
            this.passwordText.TabIndex = 11;
            // 
            // userNameText
            // 
            this.userNameText.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.userNameText.Location = new System.Drawing.Point(99, 124);
            this.userNameText.Name = "userNameText";
            this.userNameText.Size = new System.Drawing.Size(171, 30);
            this.userNameText.TabIndex = 10;
            // 
            // loginLabel
            // 
            this.loginLabel.AutoSize = true;
            this.loginLabel.Font = new System.Drawing.Font("Microsoft Sans Serif", 18F);
            this.loginLabel.Location = new System.Drawing.Point(144, 63);
            this.loginLabel.Name = "loginLabel";
            this.loginLabel.Size = new System.Drawing.Size(79, 29);
            this.loginLabel.TabIndex = 9;
            this.loginLabel.Text = "Log In";
            // 
            // signUpGroupBox
            // 
            this.signUpGroupBox.Controls.Add(this.retypePasswordLabel);
            this.signUpGroupBox.Controls.Add(this.newPasswordLabel);
            this.signUpGroupBox.Controls.Add(this.newEmailLabel);
            this.signUpGroupBox.Controls.Add(this.newUserNameLabel);
            this.signUpGroupBox.Controls.Add(this.signUpButton);
            this.signUpGroupBox.Controls.Add(this.newPassword2Text);
            this.signUpGroupBox.Controls.Add(this.newPassword1Text);
            this.signUpGroupBox.Controls.Add(this.newEmailText);
            this.signUpGroupBox.Controls.Add(this.newUsernameText);
            this.signUpGroupBox.Controls.Add(this.signUpLabel);
            this.signUpGroupBox.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.signUpGroupBox.Location = new System.Drawing.Point(428, 12);
            this.signUpGroupBox.Name = "signUpGroupBox";
            this.signUpGroupBox.RightToLeft = System.Windows.Forms.RightToLeft.Yes;
            this.signUpGroupBox.Size = new System.Drawing.Size(368, 367);
            this.signUpGroupBox.TabIndex = 11;
            this.signUpGroupBox.TabStop = false;
            this.signUpGroupBox.Text = "Sign Up";
            // 
            // retypePasswordLabel
            // 
            this.retypePasswordLabel.AutoSize = true;
            this.retypePasswordLabel.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F);
            this.retypePasswordLabel.Location = new System.Drawing.Point(74, 227);
            this.retypePasswordLabel.Name = "retypePasswordLabel";
            this.retypePasswordLabel.Size = new System.Drawing.Size(133, 20);
            this.retypePasswordLabel.TabIndex = 18;
            this.retypePasswordLabel.Text = "Retype Password";
            // 
            // newPasswordLabel
            // 
            this.newPasswordLabel.AutoSize = true;
            this.newPasswordLabel.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F);
            this.newPasswordLabel.Location = new System.Drawing.Point(74, 172);
            this.newPasswordLabel.Name = "newPasswordLabel";
            this.newPasswordLabel.Size = new System.Drawing.Size(78, 20);
            this.newPasswordLabel.TabIndex = 17;
            this.newPasswordLabel.Text = "Password";
            // 
            // newEmailLabel
            // 
            this.newEmailLabel.AutoSize = true;
            this.newEmailLabel.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F);
            this.newEmailLabel.Location = new System.Drawing.Point(74, 116);
            this.newEmailLabel.Name = "newEmailLabel";
            this.newEmailLabel.Size = new System.Drawing.Size(83, 20);
            this.newEmailLabel.TabIndex = 16;
            this.newEmailLabel.Text = "New Email";
            // 
            // newUserNameLabel
            // 
            this.newUserNameLabel.AutoSize = true;
            this.newUserNameLabel.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F);
            this.newUserNameLabel.Location = new System.Drawing.Point(74, 62);
            this.newUserNameLabel.Name = "newUserNameLabel";
            this.newUserNameLabel.Size = new System.Drawing.Size(118, 20);
            this.newUserNameLabel.TabIndex = 15;
            this.newUserNameLabel.Text = "New Username";
            // 
            // signUpButton
            // 
            this.signUpButton.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.signUpButton.Location = new System.Drawing.Point(130, 313);
            this.signUpButton.Name = "signUpButton";
            this.signUpButton.Size = new System.Drawing.Size(121, 49);
            this.signUpButton.TabIndex = 15;
            this.signUpButton.Text = "Sign Up";
            this.signUpButton.UseVisualStyleBackColor = true;
            this.signUpButton.Click += new System.EventHandler(this.signUpButton_Click);
            // 
            // newPassword2Text
            // 
            this.newPassword2Text.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.newPassword2Text.Location = new System.Drawing.Point(99, 249);
            this.newPassword2Text.Name = "newPassword2Text";
            this.newPassword2Text.Size = new System.Drawing.Size(171, 30);
            this.newPassword2Text.TabIndex = 14;
            // 
            // newPassword1Text
            // 
            this.newPassword1Text.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.newPassword1Text.Location = new System.Drawing.Point(99, 194);
            this.newPassword1Text.Name = "newPassword1Text";
            this.newPassword1Text.Size = new System.Drawing.Size(171, 30);
            this.newPassword1Text.TabIndex = 13;
            // 
            // newEmailText
            // 
            this.newEmailText.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.newEmailText.Location = new System.Drawing.Point(99, 139);
            this.newEmailText.Name = "newEmailText";
            this.newEmailText.Size = new System.Drawing.Size(171, 30);
            this.newEmailText.TabIndex = 12;
            // 
            // newUsernameText
            // 
            this.newUsernameText.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.newUsernameText.Location = new System.Drawing.Point(99, 85);
            this.newUsernameText.Name = "newUsernameText";
            this.newUsernameText.Size = new System.Drawing.Size(171, 30);
            this.newUsernameText.TabIndex = 11;
            // 
            // signUpLabel
            // 
            this.signUpLabel.AutoSize = true;
            this.signUpLabel.Font = new System.Drawing.Font("Microsoft Sans Serif", 18F);
            this.signUpLabel.Location = new System.Drawing.Point(138, 16);
            this.signUpLabel.Name = "signUpLabel";
            this.signUpLabel.Size = new System.Drawing.Size(99, 29);
            this.signUpLabel.TabIndex = 10;
            this.signUpLabel.Text = "Sign Up";
            // 
            // loginFailedLabel
            // 
            this.loginFailedLabel.AutoSize = true;
            this.loginFailedLabel.ForeColor = System.Drawing.Color.Red;
            this.loginFailedLabel.Location = new System.Drawing.Point(127, 227);
            this.loginFailedLabel.Name = "loginFailedLabel";
            this.loginFailedLabel.Size = new System.Drawing.Size(118, 25);
            this.loginFailedLabel.TabIndex = 15;
            this.loginFailedLabel.Text = "Login Failed";
            // 
            // LoginForm
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.SystemColors.ActiveCaption;
            this.ClientSize = new System.Drawing.Size(808, 391);
            this.Controls.Add(this.signUpGroupBox);
            this.Controls.Add(this.loginInGroupBox);
            this.Name = "LoginForm";
            this.Text = "LoginForm";
            this.Load += new System.EventHandler(this.LoginForm_Load);
            this.loginInGroupBox.ResumeLayout(false);
            this.loginInGroupBox.PerformLayout();
            this.signUpGroupBox.ResumeLayout(false);
            this.signUpGroupBox.PerformLayout();
            this.ResumeLayout(false);

        }

        #endregion
        private System.Windows.Forms.GroupBox loginInGroupBox;
        private System.Windows.Forms.Button signInButton;
        private System.Windows.Forms.TextBox passwordText;
        private System.Windows.Forms.TextBox userNameText;
        private System.Windows.Forms.Label loginLabel;
        private System.Windows.Forms.GroupBox signUpGroupBox;
        private System.Windows.Forms.Button signUpButton;
        private System.Windows.Forms.TextBox newPassword2Text;
        private System.Windows.Forms.TextBox newPassword1Text;
        private System.Windows.Forms.TextBox newEmailText;
        private System.Windows.Forms.TextBox newUsernameText;
        private System.Windows.Forms.Label signUpLabel;
        private System.Windows.Forms.Label passwordLabel;
        private System.Windows.Forms.Label userNameLabel;
        private System.Windows.Forms.Label retypePasswordLabel;
        private System.Windows.Forms.Label newPasswordLabel;
        private System.Windows.Forms.Label newEmailLabel;
        private System.Windows.Forms.Label newUserNameLabel;
        private System.Windows.Forms.Label loginFailedLabel;
    }
}