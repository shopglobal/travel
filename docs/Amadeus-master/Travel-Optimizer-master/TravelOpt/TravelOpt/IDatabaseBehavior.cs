using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace pg_data
{
    public interface IDatabaseBehavior
    {
        //List<Dictionary<String, String>> execute();
        void execute();
        List<Dictionary<String, String>> getResults();
    }
}
