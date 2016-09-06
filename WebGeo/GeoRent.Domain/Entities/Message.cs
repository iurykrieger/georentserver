using System;
using System.Runtime.Serialization;

namespace GeoRent.Domain.Entities
{
    [DataContract]
    public class Message
    {
        public Message()
        {
            idMessage = Guid.NewGuid();
        }

        [DataMember]
        public Guid idMessage { get; set; }
        [DataMember]
        public String message { get; set; }
        [DataMember]
        public DateTime dateTime { get; set; }
        [DataMember]
        public int resource { get; set; }
        [DataMember]
        public String path { get; set; }
        [DataMember]
        public virtual User to { get; set; }
        [DataMember]
        public virtual User from { get; set; }
    }
}