using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace pg_data
{
    public abstract class dbAbstract
    {
        public IDatabaseBehavior dbBehavior;
        public dbAbstract()
        {
        }

        public abstract void execute();
        public void run()
        {
            dbBehavior.execute();
        }
    }
}
