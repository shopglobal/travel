using System;
using System.Collections.Generic;
using System.Windows.Forms;
using pg_data;

namespace TravelOpt
{
    public partial class LoginForm : Form
    {
        public bool loggedIn = false;
        public String user_id;

        public LoginForm()
        {
            InitializeComponent();
            loginFailedLabel.Hide();
        }

        private void LoginForm_Load(object sender, EventArgs e)
        {

        }

        private void signInButton_Click(object sender, EventArgs e)
        {
            String username = this.userNameText.Text;
            String password = this.passwordText.Text;

            DbQuery dbCall = new DbQuery(@"SELECT * 
                                    FROM hack.user 
                                    WHERE username = '" + username + "' AND user_password = '" + password + "';");
            dbCall.execute();

            List<Dictionary<String, String>> result = dbCall.results;
            if (result.Count > 0)
            {
                Console.WriteLine("Logged in!");
                this.loggedIn = true;
                this.user_id = result[0]["user_id"];
                this.Close();
            }
            else
            {
                Console.WriteLine("Failed!");
                loginFailedLabel.Show();
            }
        }

        private void signUpButton_Click(object sender, EventArgs e)
        {
            String username = this.newUsernameText.Text;
            String email = this.newEmailText.Text;
            String pass1 = this.newPassword1Text.Text;
            String pass2 = this.newPassword2Text.Text;

            if (pass1 != pass2)
            {
                MessageBox.Show("Your passwords don't match!");
            }
            else
            {
                DbQuery dbCall = new DbQuery(@"SELECT * 
                                    FROM hack.user 
                                    WHERE username = '" + username + "';");
                dbCall.execute();
                List<Dictionary<String, String>>  result = dbCall.results;
                if (result.Count <= 0)
                {
                    DbQuery dbCall2 = new DbQuery(@"SELECT * 
                                    FROM hack.user 
                                    WHERE email = '" + email + "';");
                    dbCall2.execute();

                    result = dbCall2.results;
                    if (result.Count <= 0)
                    {
                        //Create account here.
                        DbManip dbInsert = new DbManip(@"INSERT INTO hack.user (
                                        username,
                                        email,
                                        user_password,
                                        first_name,
                                        last_name
                                    ) VALUES (
                                        '"+ username +"','"+ email +"','"+ pass1 + "', ' ', ' '" + @"
                                    );");
                        dbInsert.execute();

                        DbQuery userInfo = new DbQuery(@"SELECT * FROM hack.user WHERE email = '" + email + "';");
                        userInfo.execute();
                        result = userInfo.results;
                        this.loggedIn = true;
                        this.user_id = result[0]["user_id"];
                        this.Close();
                    }
                    else
                    {
                        MessageBox.Show("That email is already taken!");
                    }
                }
                else
                {
                    MessageBox.Show("That username is already taken!");
                }
            }
        }
    }
}
