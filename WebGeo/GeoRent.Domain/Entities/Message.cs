using System;

namespace GeoRent.Domain.Entities
{
    public class Message
    {
        public Message()
        {
            idMessage = Guid.NewGuid();
        }

        public Guid idMessage { get; set; }
        public String message { get; set; }
        public DateTime dateTime { get; set; }
        public int resource { get; set; }
        public String path { get; set; }
        public virtual User to { get; set; }
        public virtual User from { get; set; }
    }
}