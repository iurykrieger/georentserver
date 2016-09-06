using System;
using System.Runtime.Serialization;

namespace GeoRentWebService.Entities
{
    [DataContract]
    public class MessageEntity
    {
        public MessageEntity()
        {
            this.idMessage = idMessage;
        }

        [DataMember]
        public int idMessage { get; set; }
        [DataMember]
        public String message { get; set; }
        [DataMember]
        public DateTime dateTime { get; set; }
        [DataMember]
        public int resource { get; set; }
        [DataMember]
        public String path { get; set; }
        [DataMember]
        public virtual UserEntity to { get; set; }
        [DataMember]
        public virtual UserEntity from { get; set; }
    }
}